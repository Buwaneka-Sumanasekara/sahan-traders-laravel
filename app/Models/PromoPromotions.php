<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoPromotions extends Model
{
    use HasFactory;
    protected $table = 'promo_promotions';
    public $incrementing = false;
}
