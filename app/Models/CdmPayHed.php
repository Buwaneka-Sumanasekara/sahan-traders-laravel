<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CdmPayHed extends Model
{
    protected $table = 'cdm_pay_hed';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        "id",
        'name',
        'has_det',
        'en_front',
        'en_back',
        'over_pay',
        'is_adv_pay',
        
    ];
}
