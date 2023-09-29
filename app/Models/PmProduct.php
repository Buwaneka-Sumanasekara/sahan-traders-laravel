<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProduct extends Model
{

    use HasFactory;
    protected $table = 'pm_product';
    public $incrementing = false;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'active',
        'pm_group1_id',
        'pm_group2_id',
        'pm_group3_id',
        'pm_group4_id',
        'pm_group5_id',
        'slug',
        'is_inquiry_item',
        'note_html',
        'note',
        'is_featured_product'
    ];



    private function mainImage()
    {
        return $this->hasOne(PmProductImages::class, 'pm_product_id', 'id')->where('is_primary', true);
    }

    public function mainThumbnailImageUrl()
    {
        $mainImage = $this->mainImage()->where('pm_product_id', $this->id)->first();
        $product_path = 'images/products/' . $this->id . '/thumbnails/';
        return $mainImage ? url($product_path . $mainImage->name) : "";
    }

    public function images()
    {
        return $this->hasMany(PmProductImages::class, 'pm_product_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(PmProductStock::class, 'pm_product_id', 'id');
    }
}
