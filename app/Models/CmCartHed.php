<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CmCartHed extends Model
{
    use HasFactory;
    protected $table = 'cm_cart_hed';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $keyType = 'string';


    public function cartDetItems(): HasMany
    {
        return $this->hasMany(CmCartDet::class);
    }

    public function buyer(): HasOne
    {
        return $this->hasOne(BmBuyer::class);
    }

    

    public function getDisplayTotal()
    {
        $price = $this->net_amount;
        return money($price, config('setup.base_country_id'));
    }
}
