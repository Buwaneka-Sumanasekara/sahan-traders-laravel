<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CmCartHed;
use App\Models\CmCartDet;
use App\Models\BmBuyer;
use App\Models\BmBuyerAddress;
use App\Models\PmProductAdditionalCost;

use Illuminate\Support\Facades\DB;
use stdClass;



class CusModel_Buyer extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;



    /*===========================Helper functions===========================================*/

    private function generateNextBuyerId()
    {
        $lastId = BmBuyer::max("id");
        if ($lastId) {
            return $lastId + 1;
        } else {
            return 1;
        }
    }
    private function generateNextBuyerAddressId()
    {
        $lastId = BmBuyerAddress::max("id");
        if ($lastId) {
            return $lastId + 1;
        } else {
            return 1;
        }
    }


    public function updateBuyerAddress(string $userId, BmBuyerAddress $address, $type = "both")
    {
        try {
          
            DB::beginTransaction();
            $buyer = BmBuyer::where('id', $userId)->first();

            if ($buyer) {

                $hasShipAddress = isset($buyer->address_ship_id);
                $hasBillAddress = isset($buyer->address_bill_id);

                $isUpdate=true;

                if ($type == "shipping") {
                    if ($hasShipAddress) {
                        $address->id = $buyer->address_ship_id;
                    } else {
                        $address->id = $this->generateNextBuyerAddressId();
                        $isUpdate=false;
                    }
                } else if ($type == "billing") {
                    if ($hasBillAddress) {
                        $address->id = $buyer->address_bill_id;
                    } else {
                        $address->id = $this->generateNextBuyerAddressId();
                        $isUpdate=false;
                    }
                } else {
                    if ($hasShipAddress) {
                        $address->id = $buyer->address_ship_id;
                    } else if ($hasBillAddress) {
                        $address->id = $buyer->address_bill_id;
                    } else {
                        $address->id = $this->generateNextBuyerAddressId();
                        $isUpdate=false;
                    }
                }

               
                if($isUpdate){
                    $address->update();
                }else{
                    $address->save();
                }

                if ($type == "shipping") {
                    $buyer->address_ship_id = $address->id;
                } else  if ($type == "billing") {
                    $buyer->address_bill_id = $address->id;
                } else {
                    $buyer->address_ship_id = $address->id;
                    $buyer->address_bill_id = $address->id;
                }

                $buyer->save();
            } else {
                throw new \Exception("Buyer not found");
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
