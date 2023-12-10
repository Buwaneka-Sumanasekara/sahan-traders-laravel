<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmBuyer extends Model
{
    use HasFactory;
    protected $table = 'bm_buyer';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function shippingAddress()
    {
        return $this->belongsTo(BmBuyerAddress::class, 'address_ship_id', 'id');
    }
    public function billingAddress()
    {
        return $this->belongsTo(BmBuyerAddress::class, 'address_bill_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(UmUser::class, 'user_id', 'id');
    }

    public function hasShippingAddress()
    {
        return $this->address_ship_id != null;
    }
}
