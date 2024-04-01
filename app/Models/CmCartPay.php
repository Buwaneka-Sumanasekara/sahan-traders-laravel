<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmCartPay extends Model
{
    protected $table = 'cm_cart_pay';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        "id",
        'cm_cart_hed_id',
        'frg_amount',
        'paid_amount',
        'balance_amount',
        'ref_no',
        'cdm_pay_hed_id',
        'cdm_pay_det_id',
        'cm_cart_pay_status_id',
        
    ];
    
}
