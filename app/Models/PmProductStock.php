<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductStock extends Model
{
    use HasFactory;
    protected $table = 'pm_product_stock';

    protected $fillable = [
        'pm_product_id',
        'batch'
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
        return money($this->sell_price, config('setup.base_country_id'));
    }
}
