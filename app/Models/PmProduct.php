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
    protected $keyType = 'string';

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
        'is_featured_product',
        'prop_width',
        'prop_height',
        'prop_depth',
        'prop_weight',
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
    public function productVarients()
    {
        return $this->hasMany(PmProductVarient::class, 'product_id', 'id')->where('active', true);
    }

    public function productAdditionalCosts()
    {
        return $this->hasMany(PmProductAdditionalCost::class, 'product_id', 'id')->where('active', true);
    }

    public function hasMultipleVarients(){
        return $this->productVarients()->count()>1;
    }
    public function hasAdditionalCosts(){
        return $this->productAdditionalCosts()->count()>0;
    }



    public function getDefaultProductVarient(){
        return $this->productVarients()->first();
    }

    public function getFIFOStock($varientId)
    {
        if(isset($varientId)){
            return $this->stocks()->where("qty", ">", 0)->where("pm_product_varient_id",$varientId)->orderBy('batch', 'asc')->first();     
        }
        $productDefaultVarient=$this->getDefaultProductVarient();
        return $this->stocks()->where("qty", ">", 0)->where("pm_product_varient_id",$productDefaultVarient->id)->orderBy('batch', 'asc')->first();
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

    public function getAvailableStockQty($varientId)
    { //oldest stock
        return $this->getFIFOStock($varientId)->qty;
    }

    public function getAvailableStockQtyByBatch($batch,$varientId)
    {
        $stock = $this->stocks()->where("batch", $batch)->where("pm_product_varient_id",$varientId)->first();
        return $stock ? $stock->qty : 0;
    }

    public function getFIFOStockId($varientId)
    {
        $stock = $this->getFIFOStock($varientId);
        return $stock ? $stock->batch : "";
    }

    public function getFIFOStockQty($varientId): float
    {
        $stock = $this->getFIFOStock($varientId);
        return $stock ? $stock->qty : 0;
    }

    public function getFIFOStockPrice($varientId)
    {
        $stock = $this->getFIFOStock($varientId);
        return $stock ? $stock->sell_price : 0;
    }

    public function getDisplayPrice($varientId)
    {
        $price = $this->getFIFOStockPrice($varientId) ? $this->getFIFOStockPrice($varientId) : 0;
        return money($price, config('setup.base_country_id'));
    }

    public function getDisplaySKU($varientId=1)
    {
        $stock = $this->getFIFOStock($varientId);
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



    public function isOutOfStock($varientId): bool
    {

        $qty = $this->getFIFOStockQty($varientId);
        return $qty <= 0;
    }

    public function isQtyAvailableInStock($checkQty = 1,$varientId): bool
    {
        $qty = $this->getFIFOStockQty($varientId);
        return  $checkQty <= $qty;
    }

    public function getDefaultSalesUnitId()
    {
        return PmUnitHasPmUnitGroup::where("pm_unit_group_id", $this->pm_unit_group_id)
            ->where("active", true)->where("is_sales_unit", true)->first()->pm_unit_id;
    }
}
