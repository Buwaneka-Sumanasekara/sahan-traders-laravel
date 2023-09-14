<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmPermissions extends Model
{
    use HasFactory;
    protected $table = 'sm_permissions';
    public $timestamps = false;
}
