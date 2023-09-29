<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductImages extends Model
{
    use HasFactory;
    protected $table = 'pm_product_images';


    protected $fillable = [
        'id',
        'pm_product_id',
        "path"
    ];

    public function product()
    {
        return $this->belongsTo(PmProduct::class, 'pm_product_id', 'id');
    }

    public function isPrimary()
    {
        return $this->is_primary;
    }
}
