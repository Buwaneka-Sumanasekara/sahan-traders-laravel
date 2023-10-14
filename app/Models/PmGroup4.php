<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PmGroup4 extends Model
{
    use HasFactory;
    protected $table = 'pm_group4';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function products(): HasMany
    {
        return $this->hasMany(PmProduct::class);
    }
}
