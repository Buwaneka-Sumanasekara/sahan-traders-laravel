<?php

namespace App\Http\Controllers;

use App\CustomModels\CusModel_Buyer;
use App\CustomModels\CusModel_Cart;
use App\Exceptions\EmailNotVerifiedException;
use App\Http\Resources\CommonResponseResource;
use App\Http\Resources\ErrorResource;
use App\Models\BmBuyerAddress;
use App\Models\CdmCountry;
use Illuminate\Http\Request;
use stdClass;

class BuyerController extends Controller
{
    /**
     * Instantiate a new VerificationController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function api_updateBuyerAddress(Request $request)
    {

        try {
            if ($request->user()->hasVerifiedEmail()) {
                $userId = $request->user()->id;


                $address1 = $request->input('address1');
                $address2 = $request->input('address2');
                $city = $request->input('city');
                $zipCode = $request->input('zipCode');
                $province = $request->input('province');
                $countryId = $request->input('countryId');

                $addressType = $request->input('addressType');

                $updateCart = $request->input('updateCart');

                $isUpdateMultiple = (isset($addressType) ? false : true);

                $needToUpdateCart = (isset($updateCart) ? true : false);

                $addressTypeCheck = false;

                if ($addressType == "shipping" || $addressType == "billing") {
                    $addressTypeCheck = true;
                }

                if($isUpdateMultiple && !$addressTypeCheck){
                    throw new \Exception("Invalid address type");
                }


                if (!isset($countryId)) {
                    throw new \Exception("Country code is required");
                }

                $country = CdmCountry::where("id", $countryId)->where("active", 1)->first();

                if (!$country) {
                    throw new \Exception("Invalid country code");
                } else  if (!isset($address1)) {
                    throw new \Exception("Address 1 is required");
                } else if (!isset($city)) {
                    throw new \Exception("city is required");
                } else if (!isset($zipCode)) {
                    throw new \Exception("Zip Code is required");
                } else if (!isset($province)) {
                    throw new \Exception("Province is required");
                }

                $buyerModel = new CusModel_Buyer();

                $address = new BmBuyerAddress();
                $address->address_1 = $address1;
                $address->address_2 = ((isset($address2)) ? $address2 : "");
                $address->city = $city;
                $address->zip_code = $zipCode;
                $address->province_name = $province;
                $address->cdm_country_id = $countryId;



                if($isUpdateMultiple){
                    $buyerModel->updateBuyerAddress($userId,$address, "both");
                }else{
                    $buyerModel->updateBuyerAddress($userId,$address, $addressType);
                }


                if($needToUpdateCart){
                   
                    $cartHed = CusModel_Cart::getActiveCartHedByUserId($userId);
                    $cartModel = new CusModel_Cart();
                    $cartModel->updateCartAddressAndReCalculate($cartHed);
                }
               
                return (new CommonResponseResource([
                    "status" => "success"
                ]));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }
}
