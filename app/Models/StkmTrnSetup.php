<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StkmTrnSetup extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'stkm_trn_setup';
    public $incrementing = false;
    protected $primaryKey = 'id';
    public $timestamps = false;
}
