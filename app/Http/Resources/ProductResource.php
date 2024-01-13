<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // dd($this);
       
       $variantId="";
       $stock=null;

       $stockId="";
       if(isset($this->variantId)){
        $variantId=$this->variantId;
        $stock=$this->getFIFOStockByVarientId($variantId);
       
       }else{
        $stock=$this->getFIFOStockWithVariant();
        $variantId=$stock->pm_product_variant_id;
       }

       $stockId=$stock->batch;
       $sellPrice=$this->getSellPrice($stockId,$variantId);

       $arVariants=[];

         foreach($this->stocks as $stock){
            $variant=$stock->variant;
            $variant->stockId=$stock->batch;
            $variant->sellPrice=$stock->sell_price;
            $variant->displaySellPrice=$this->getDisplayPrice($stock->sell_price);
            $variant->costPrice=$stock->cost_price;

            $arVariants[]=$variant;
         }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'isInquiryItem' => $this->is_inquiry_item,
            'isQtyAvailableInStock'=>!$this->isQtyOutOfStock($stockId,$variantId),
            'mainThumbnailImageUrl' => $this->mainThumbnailImageUrl(),
            'displayPrice'=>$this->getDisplayPrice($sellPrice),
            'price'=>$sellPrice,
            'variantId'=>$variantId,
            'stockId'=>$stockId,
            'unitId'=>$this->getDefaultSalesUnitId(),
            'unitGroupId'=>$this->pm_unit_group_id,
            'avilableStockQty'=>$stock->qty,
            'variants'=>$arVariants,
        ];
    }
}
