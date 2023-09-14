<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmUserRole extends Model
{
    use HasFactory;
    protected $table = 'um_user_role';
    public $timestamps = false;
}
