<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function App\Helpers\convertToDisplayPrice;

class PmProductStock extends Model
{
    use HasFactory;
    protected $table = 'pm_product_stock';
    public $incrementing = false;

    protected $fillable = [
        'pm_product_id',
        'batch',
        'qty',
        'sell_price',
        'cost_price',
        'pm_product_variant_id',
        'pm_product_variant_group_id',
        'pm_unit_group_id',
        'pm_unit_id'
    ];

    public function product()
    {
        return $this->belongsTo(PmProduct::class, 'pm_product_id', 'id');
    }

    public function isOutOfStock()
    {
        return $this->qty <= 0;
    }

    public function displayPrice()
    {
        return convertToDisplayPrice($this->sell_price);
    }

    public function displayCostPrice()
    {
        return convertToDisplayPrice($this->cost_price);
    }

    public function variant()
    {
        return $this->belongsTo(PmProductVariant::class, 'pm_product_variant_id', 'id');
    }

    public function variantGroup()
    {
        return $this->belongsTo(PmProductVariantGroup::class, 'pm_product_variant_group_id', 'id');
    }
}
