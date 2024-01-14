<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Number;

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
        return $this->hasOne(BmBuyer::class);
    }

    public function totalNetAmountDisplay(){
        if($this->net_amount){
            return  Number::currency($this->net_amount, config("setup.base_country_id"));
        }else{
            return Number::currency(0, config("setup.base_country_id"));
        }
        
    }
    public function totalGrossAmountDisplay(){
        return  Number::currency($this->gross_amount, config("setup.base_country_id"));
    }
    

   
}
