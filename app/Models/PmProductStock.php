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
}
