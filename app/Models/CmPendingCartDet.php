<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmPendingCartDet extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'cart_id',
        'product_id',
        'stock_id',
        'qty',
        'amount'
    ];
}
