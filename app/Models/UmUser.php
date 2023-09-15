<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UmUser extends Model
{
    use Notifiable;
    protected $table = 'um_user';
}
