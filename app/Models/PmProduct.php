<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->hasMany(PmProductStock::class, 'pm_product_id', 'id')->where('active', true);
    }

    public function getFIFOStock()
    {
        return $this->stocks()->where("qty", ">", 0)->orderBy('batch', 'asc')->first();
    }

    public function group1(): BelongsTo
    {
        return $this->belongsTo(PmGroup1::class, 'pm_group1_id', "id");
    }
    public function group2(): BelongsTo
    {
        return $this->belongsTo(PmGroup2::class, 'pm_group2_id', "id");
    }
    public function group3(): BelongsTo
    {
        return $this->belongsTo(PmGroup3::class, 'pm_group3_id', "id");
    }
    public function group4(): BelongsTo
    {
        return $this->belongsTo(PmGroup4::class, 'pm_group4_id', "id");
    }
    public function group5(): BelongsTo
    {
        return $this->belongsTo(PmGroup5::class, 'pm_group5_id', "id");
    }


    //Other getters

    public function getAvailableStockQty()
    { //oldest stock
        return $this->getFIFOStock()->qty;
    }

    public function getAvailableStockQtyByBatch($batch)
    {
        $stock = $this->stocks()->where("batch", $batch)->first();
        return $stock ? $stock->qty : 0;
    }

    public function getFIFOStockId()
    {
        $stock = $this->getFIFOStock();
        return $stock ? $stock->batch : "";
    }

    public function getFIFOStockQty(): float
    {
        $stock = $this->getFIFOStock();
        return $stock ? $stock->qty : 0;
    }

    public function getFIFOStockPrice()
    {
        $stock = $this->getFIFOStock();
        return $stock ? $stock->sell_price : 0;
    }

    public function getDisplayPrice()
    {
        $price = $this->getFIFOStockPrice() ? $this->getFIFOStockPrice() : 0;
        return money($price, config('setup.base_country_id'));
    }

    public function getDisplaySKU()
    {
        $stock = $this->getFIFOStock();
        return $stock ? $this->id . "-" . $stock->batch : "";
    }

    public function getDisplayCategoryValue()
    {
        return  strtoupper($this->group4->name);
    }

    public function getDisplayCategoryName()
    {
        return strtoupper(config("setup.product_group4_name"));
    }

    public function isOutOfStock(): bool
    {
        $qty = $this->getFIFOStockQty();
        return $qty <= 0;
    }
}
