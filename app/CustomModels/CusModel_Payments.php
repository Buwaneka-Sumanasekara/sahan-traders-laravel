<?php

namespace App\CustomModels;

use App\Http\Resources\StripePaymentInitResource;
use App\Models\CmCartHed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CmCartPay;

use Illuminate\Support\Facades\DB;

use function App\Helpers\convertToPrice;
use function App\Helpers\getValueFromObjectArray;

class CusModel_Payments extends Model
{
    use HasFactory;


    /*===========================Helper functions===========================================*/

    private function generateNextCartPaymentId($cartId)
    {
        $lastId = CmCartPay::where('cm_cart_hed_id', $cartId)->max("id");
        if ($lastId) {
            return $lastId + 1;
        } else {
            return 1;
        }
    }

    private function getDecodedPaymentSessionId($id)
    {

        $decoded = base64_decode($id);
        $removeFirstThreeAndLastThreeChar = substr($decoded, 3, strlen($decoded) - 6);

        $decodedArr = explode("-", $removeFirstThreeAndLastThreeChar);

    
       
        return [
            "type" => $decodedArr[0],
            "id" => $decodedArr[1],
            "subId" => $decodedArr[2],
        ];
    }

    private function getEncodedPaymentSessionId($type, $id, $subId)
    {
        $id = $type . "-" . $id . "-" . $subId;

        $genId = rand(100, 999) . "" . $id . "" . rand(100, 999);

        return base64_encode($genId);
    }

    /*===========================Payment functions===========================================*/



    private function saveNewPaymentDet(CmCartHed $cartHed)
    {

        $cartPay = new CmCartPay();
        $cartPay->id = $this->generateNextCartPaymentId($cartHed->id);
        $cartPay->cm_cart_hed_id = $cartHed->id;
        $cartPay->frg_amount = $cartHed->net_amount;
        $cartPay->paid_amount = 0;
        $cartPay->balance_amount = $cartHed->net_amount;
        $cartPay->ref_no = "";

        $cartPay->cdm_pay_hed_id = config("global.payment_hed_type.stripe");
        $cartPay->cdm_pay_det_id = config("global.payment_det_type.online");

        $cartPay->cm_cart_pay_status_id = config("global.cart_pay_status.pending");

        $cartPay->save();

        return $cartPay;
    }

    private function getPaymentDet($cartId, $cartPayId)
    {
        $cartPay = CmCartPay::where("cm_cart_hed_id", $cartId)->where("id", $cartPayId)->first();
        return $cartPay;
    }

    /*======================= Common function ==============================================*/
    public function generatePaymentLink($type, $id, $subId = null)
    {
        try {
            $sessionId = null;
            if (config("global.payment_link_type.cart") == $type) {
                $cartHed = CmCartHed::where("id", $id)->first();

                if (!$cartHed) {
                    throw new \Exception("Cart not found");
                }
                if (!$cartHed->isElegableToGenPayLink()) {
                    throw new \Exception("Could not create a payment link since its not eligable to create a payment link.");
                }
                $cartPayDet = null;
                if ($subId) {
                    $cartPayDet = $this->getPaymentDet($id, $subId);
                    if (!$cartPayDet) {
                        throw new \Exception("Payment record not found");
                    }
                }
                $cartPayDet = $this->saveNewPaymentDet($cartHed);

                $sessionId = $this->getEncodedPaymentSessionId( $type,$cartHed->id, $cartPayDet->id,);
            } else {
                throw new \Exception("Invalid payment link type");
            }




            $url = url("/payment/checkout/" . $sessionId);
            return [
                "url" => $url,
                "sessionId" => $sessionId
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getVerifyPaymentInfoFromSessionId($id)
    {

        $info = $this->getDecodedPaymentSessionId($id);

        if ($info["type"] == config("global.payment_link_type.cart")) {
            $cartPay = CmCartPay::where("id", $info["subId"])->where("cm_cart_hed_id", $info["id"])->first();

            if (!$cartPay) {
                throw new \Exception("Payment record not found");
            }
            return true;
        } else {
            throw new \Exception("Invalid payment link type");
        }
    }


    public function getPaymentInfoFromSessionId($id)
    {
        $info = $this->getDecodedPaymentSessionId($id);
       // dd($info);
        if (config("global.payment_link_type.cart") == $info["type"]) {
         
            $cartPay = CmCartPay::where("id", $info["subId"])->where("cm_cart_hed_id", $info["id"])->first();

            if (!$cartPay) {
                throw new \Exception("Payment record not found");
            }

            $cartHed = CmCartHed::where("id", $info["id"])->first();


            return new StripePaymentInitResource([
                "sessionId" => $id,
                "amount" =>$cartHed->net_amount,
            ]);
        } else {
            throw new \Exception("Invalid payment link type");
        }
    }
}
