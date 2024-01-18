<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use function App\Helpers\convertToDisplayPrice;

class CmCartDet extends Model
{
    use HasFactory;
    protected $table = 'cm_cart_det';



    public function product()
    {
        return $this->belongsTo(PmProduct::class, 'product_id', 'id');
    }

    public function cart()
    {
        return $this->belongsTo(CmCartHed::class, 'cm_cart_hed_id', 'id');
    }

    public function displaySellPrice(){
        return  convertToDisplayPrice($this->sprice);
    }
    public function displayCostPrice(){
        return  convertToDisplayPrice($this->cprice);
    }
    public function displayAmountPrice(){
        return  convertToDisplayPrice($this->amount);
    }
}
