<?php

namespace App\CustomModels;

use App\Models\CmCartDet;
use App\Models\PmProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function App\Helpers\convertToDisplayableCarrier;
use function App\Helpers\convertToDisplayPrice;
use function App\Helpers\getShipAndCoApiHttp;
use App\Exceptions\ShipAndCoException;
use App\Models\CmCartHed;
use Illuminate\Database\Eloquent\Collection;

class CusModel_ShipAndCoRates extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'carrier_id';
    public $timestamps = false;

    protected $fillable = [
        "from_address", //json
        "to_address", //json
        "products", //json
        "parcels",
    ];

    private function fromAddress()
    {
        if (config("app.is_production")) { //TODO: change this to check if the app is running on production
            
            
            return json_encode([
                "name" => config("app.company_name"),
                "phone" => config("app.company_phone"),
                "country" => config("app.company_country"),
                "address_1" => config("app.company_address1"),
                "address_2" => config("app.company_address2"),
                "city" => config("app.company_city"),
                "province_name" => config("app.company_province"),
                "zip_code" => config("app.company_zip"),
                "email" => config("app.company_email"),
                "courier_country_code" => config("app.company_courier_country_code"),
            ]);
        } else {
            return json_encode([
                "name" => "Yamada Taro",
                "phone" => "08012341234",
                "country" => "JP",
                "address_1" => "OSAKAFU",
                "address_2" => "OTECHO",
                "city" => "IBARAKI SHI",
                "province_name" => "OSAKA",
                "zip_code" => "5670883",
                "email" => "ytaro@worldcompany.com",
                "courier_country_code" => "JP",

            ]);
        }
    }


    private function convertAddress($address)
    {
        $addressJson = json_decode($address);
        if($addressJson->name !=="John Doe"){
           // dd($addressJson);
        }
      
        $addressOut = [
            "full_name" => isset($addressJson->name) ? $addressJson->name : "",
            "phone" => isset($addressJson->phone) ? $addressJson->phone : "",
            "country" => isset($addressJson->courier_country_code) ? $addressJson->courier_country_code : "",
            "address1" => isset($addressJson->address_1) ? $addressJson->address_1 : "",
            "address2" => isset($addressJson->address_2) ? $addressJson->address_2 : "",
            "city" => isset($addressJson->city) ? $addressJson->city : "",
            "province" => isset($addressJson->province_name) ? $addressJson->province_name : "",
            "zip" => isset($addressJson->zip_code) ? $addressJson->zip_code : "",
            "email" => isset($addressJson->email) ? $addressJson->email : "",
        ];
        return $addressOut;
    }

    private function convertProduct(CmCartDet $cartItem)
    {
        $product = PmProduct::find($cartItem->product_id);
        $productOut = [
            "name" => $product->name,
            "weight" => $product->prop_weight,
            "quantity" => $cartItem->qty,
            "price" => $cartItem->sprice,
            "origin_country"=>config("app.company_courier_country_code")
        ];
        return $productOut;
    }

    private function convertToParsals(Collection $cartItems)
    {
        $weight = 0;
        $amount = 0;
        $width = 0;
        $height = 0;
        $depth = 0;

        foreach ($cartItems as $cartItem) {
            $product = PmProduct::find($cartItem->product_id);
            $weight += $product->prop_weight;
            $amount += $cartItem->qty;
            $width += $product->prop_width;
            $height += $product->prop_height;
            $depth += $product->prop_depth;
        }


        return [
            [
                "weight" => $weight,
                "amount" => 1,
                "width" => $width,
                "height" => $height,
                "depth" => $depth,
            ]
        ];
    }

    public function getShippingCarriersList()
    {
        $response = getShipAndCoApiHttp()->get("/carriers");
        $body = $response->json();
        if ($response->successful()) {
            return $body;
        } else {
            $body = $response->json();
            throw new ShipAndCoException($body);
        }
    }

    public function getShippingCarriersRateList(CmCartHed $cartHed, Collection $cartItems)
    {
        $data= [
            "from_address" => $this->convertAddress($this->fromAddress()),
            "to_address" => $this->convertAddress($cartHed->ship_address),
            "products" => $cartItems->map(function ($cartItem) {
                return $this->convertProduct($cartItem);
            })->toArray(),
            "parcels" =>  $this->convertToParsals($cartItems)
        ];
        $response = getShipAndCoApiHttp()->post("/rates",$data);

        $body = $response->json();
        if ($response->successful()) {
            
            $resp= array_map(
                fn ($item) => $this->getCarrierInfo($item),
                $body
            );

            return $resp;
        } else {
            $body = $response->json();
            throw new ShipAndCoException($body);
        }
    }

    public function calculateAndGetShippingCost(CmCartHed $cartHed)
    {
       $courierRates=json_decode($cartHed->carrier_info);

       $shippingCost=isset($courierRates->price) ? $courierRates->price : 0;

       if(isset($courierRates->surcharges)){
        foreach($courierRates->surcharges as $surcharge){
            if(isset($surcharge->price)){
                $shippingCost+=$surcharge->price;
            }
        }
       }
       

         return $shippingCost;  
    }

    public function getCarrierInfo(array $carrierInfo)
    {

        $totalCost=$carrierInfo['price'];

        if(isset($carrierInfo['surcharges'])){
            foreach($carrierInfo['surcharges'] as $surcharge){
                if(isset($surcharge['price'])){
                    $totalCost+=$surcharge['price'];
                }
            }
        }
      

        $carrierInfo['uniqueId']=$carrierInfo['carrier_id'].'_'.$carrierInfo['service'];
        $carrierInfo['displayShippingCost']=convertToDisplayPrice($totalCost);
        $carrierInfo['displayCarrier']=convertToDisplayableCarrier($carrierInfo['carrier']);
        $carrierInfo['displayService']=convertToDisplayableCarrier($carrierInfo['service']);
       return $carrierInfo;
    }
}
