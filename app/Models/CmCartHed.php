<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return $this->hasOne(BmBuyer::class);
    }

    public function totalNetAmountDisplay(){
        return convertToDisplayPrice($this->net_amount);
    }
    public function totalGrossAmountDisplay(){
        return  convertToDisplayPrice($this->gross_amount);
    }

    public function taxAmount(){
        $taxAmount=($this->gross_amount*$this->tax_per)/100;
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
   
}
