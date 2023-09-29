<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductImages extends Model
{
    use HasFactory;
    protected $table = 'pm_product_images';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'pm_product_id',
        "path"
    ];

    public function product()
    {
        return $this->belongsTo(PmProduct::class, 'pm_product_id', 'id');
    }

    public function getThumbnailPath()
    {
        $image_name = $this->name;
        $product_path = 'images/products/' . $this->pm_product_id . '/thumbnails/';
        return url($product_path . $image_name);
    }
    public function getMainPath()
    {
        $image_name = $this->name;
        $product_path = 'images/products/' . $this->pm_product_id . '/';
        return url($product_path . $image_name);
    }

    public function isPrimary()
    {
        return $this->is_primary;
    }
}
