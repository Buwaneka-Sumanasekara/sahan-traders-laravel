<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CmCartDet extends Model
{
    use HasFactory;
    protected $table = 'cm_cart_det';



    public function product()
    {
        return $this->belongsTo(PmProduct::class, 'product_id', 'id');
    }

    public function cart()
    {
        return $this->belongsTo(CmCartHed::class, 'cm_cart_hed_id', 'id');
    }
}
