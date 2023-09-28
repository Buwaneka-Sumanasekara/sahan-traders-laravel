<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmGroupMapping extends Model
{

    use HasFactory;
    protected $table = 'pm_group_mapping';
    public $timestamps = false;
}
