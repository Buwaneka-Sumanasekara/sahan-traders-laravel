<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function App\Helpers\convertToDisplayPrice;

class PmProductAdditionalCost extends Model
{
    use HasFactory;
    protected $table = 'pm_product_additional_cost';
    public $incrementing = false;


    public function getDisplayPrice()
    { 
        return  convertToDisplayPrice($this->amount);
    }
}
