<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CusModel_ShipAndCoRates extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'carrier_id';
    public $timestamps = false;

    protected $fillable = [
        'carrier_id',
        'carrier',
        'service',
        'currency',
        'price',
        'surcharges' //json
    ];

    
}
