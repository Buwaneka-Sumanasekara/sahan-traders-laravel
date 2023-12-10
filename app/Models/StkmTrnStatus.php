<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StkmTrnStatus extends Model
{
    use HasFactory;
    protected $table = 'stkm_trn_status';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
