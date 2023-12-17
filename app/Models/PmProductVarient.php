<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductVarient extends Model
{
    use HasFactory;
    protected $table = 'pm_product_varient';
    public $incrementing = false;
}
