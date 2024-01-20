<?php

namespace App\Models;

use App\CustomModels\CusModel_ShipAndCoRates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use function App\Helpers\convertToDisplayPrice;

class CmCartHed extends Model
{
    use HasFactory;
    protected $table = 'cm_cart_hed';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $keyType = 'string';


    protected $fillable = [
        "id",
        'gross_amount'
    ];

    public function cartDetItems(): HasMany
    {
        return $this->hasMany(CmCartDet::class, 'cm_cart_hed_id', 'id');
    }

    public function buyer(): HasOne
    {
        return $this->hasOne(BmBuyer::class, 'id', 'bm_buyer_id');
    }


    public function shippingAddressCountry(): BelongsTo
    {
        return $this->belongsTo(CdmCountry::class,"ship_address_country_id","id");
    }

    public function billingAddressCountry(): BelongsTo
    {
        return $this->belongsTo(CdmCountry::class,"bill_address_country_id","id");
    }

    public function totalNetAmountDisplay(){
        return convertToDisplayPrice($this->net_amount);
    }
    public function totalGrossAmountDisplay(){
        return  convertToDisplayPrice($this->gross_amount);
    }

    public function taxAmount(){
        $taxAmount=$this->tax_amount;
        return  $taxAmount;
    }

   

    public function taxAmountDisplay(){
        return  convertToDisplayPrice($this->taxAmount());
    }


    public function discountPerAmount(){
        $disCountAmount=($this->gross_amount*$this->dis_per)/100;
        return  $disCountAmount;
    }

    public function discountPerAmountDisplay(){
        return  "-".convertToDisplayPrice($this->discountPerAmount());
    }
   
    public function shippingCostDisplay(){
        return  convertToDisplayPrice($this->shipping_cost);
    }

    public function hasShippingAddress(){
        return  $this->ship_address!=null;
    }

    public function getShippingAddress(){
        if($this->ship_address!==null){
            return  json_decode($this->ship_address, true);;
        }
        return  null;
    }
    public function getBillingAddress(){
        if($this->bill_address!==null){
            return  json_decode($this->bill_address, true);;
        }
        return  null;
    }

    public function getCarrierInfo(){
        if($this->carrier_info!==null){
            $carrierInfo=json_decode($this->carrier_info, true);
            $shipAndCoRates=new CusModel_ShipAndCoRates();
            return  $shipAndCoRates->getCarrierInfo($carrierInfo);
        }
        return  null;
    }
   
}
