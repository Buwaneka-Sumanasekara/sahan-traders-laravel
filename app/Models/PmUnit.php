<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmUnit extends Model
{
    use HasFactory;
    protected $table = 'pm_unit';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'name',
        'symbol',
        'active'
    ];

    public $timestamps = false;
}
