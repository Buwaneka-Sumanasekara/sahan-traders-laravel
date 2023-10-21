<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmPendingCartHed extends Model
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
        'id',
        'items_count',
        'gross_amount',
        'net_dis',
        'net_amount'
    ];
}
