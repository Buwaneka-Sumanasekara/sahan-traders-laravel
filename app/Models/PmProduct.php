<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use function App\Helpers\convertToDisplayPrice;

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
        'pm_unit_group_id',
        'pm_product_variant_group_id'
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
   
    
    public function productAdditionalCosts()
    {
        return $this->hasMany(PmProductAdditionalCost::class, 'product_id', 'id')->where('active', true);
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
    public function unitGroup(): BelongsTo
    {
        return $this->belongsTo(PmUnitGroup::class, 'pm_unit_group_id', "id");
    }

    public function hasAdditionalCosts(){
        return $this->productAdditionalCosts()->count()>0;
    }

    public function getFIFOStock()
    {
        return $this->stocks()->where("qty", ">", 0)->orderBy('batch', 'asc')->first();
    }





    /*=======================Get defaults=====================================*/

    //Default variant will be the first variant of avilable stocks
    public function getFIFOStockWithVariant():PmProductStock
    {
        return $this->stocks()->where("qty", ">", 0)->orderBy('pm_product_variant_id', 'asc')->first();
    }
    
    public function getFIFOStockByVarientId($variantId):PmProductStock
    {
        return $this->stocks()->where("qty", ">", 0)->where("pm_product_variant_id",$variantId)->orderBy('batch', 'asc')->first();
    }

    public function getStockByIdAndVariantId($stockId,$variantId)
    {
        return $this->stocks()->where("batch", $stockId)->where("pm_product_variant_id",$variantId)->first();
    }
    

    public function isQtyAvailableInStock($stockId,$variantId,$qty=1): bool
    {
        $stock = $this->getStockByIdAndVariantId($stockId,$variantId);
        return  $qty <= $stock->qty;
    }
   
    public function isQtyOutOfStock($stockId,$variantId): bool
    {
        $stock = $this->getStockByIdAndVariantId($stockId,$variantId);
        return $stock->qty<=0;
    }

    public function getSellPrice($stockId,$variantId)
    {
        $stock=$this->getStockByIdAndVariantId($stockId,$variantId);
        return $stock->sell_price;
    }
    public function getCostPrice($stockId,$variantId)
    {
        $stock=$this->getStockByIdAndVariantId($stockId,$variantId);
        return $stock->cost_price;
    }

    public function getDefaultSalesUnitId()
    {
        return PmUnitHasPmUnitGroup::where("pm_unit_group_id", $this->pm_unit_group_id)
            ->where("active", true)->where("is_sales_unit", true)->first()->pm_unit_id;
    }



    //helpers
    public function getDisplaySellingPrice($stockId,$variantId)
    { 
        return  convertToDisplayPrice($this->getSellPrice($stockId,$variantId));
    }

 
    
   
}
