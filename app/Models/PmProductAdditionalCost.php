<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductAdditionalCost extends Model
{
    use HasFactory;
    protected $table = 'pm_product_additional_cost';
    public $incrementing = false;
}
