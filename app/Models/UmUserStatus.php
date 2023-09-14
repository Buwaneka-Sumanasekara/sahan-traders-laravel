<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmUserStatus extends Model
{
    use HasFactory;
    protected $table = 'um_user_status';
    public $timestamps = false;
}
