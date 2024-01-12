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
       
        $varientId=isset($this->varientId)?$this->varientId:$this->getDefaultProductVarient()->id;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'isInquiryItem' => $this->is_inquiry_item,
            'isQtyAvailableInStock'=>$this->isQtyAvailableInStock(1,$varientId),//default varient id is 1
            'mainThumbnailImageUrl' => $this->mainThumbnailImageUrl(),
            'displayPrice'=>$this->getDisplayPrice($varientId),
            'price'=>$this->getFIFOStockPrice($varientId),
            'varientId'=>$varientId,
            'stockId'=>$this->getFIFOStockId($varientId),
            'unitId'=>$this->getDefaultSalesUnitId(),
            'unitGroupId'=>$this->pm_unit_group_id,
            'avilableStockQty'=>$this->getAvailableStockQty($varientId),
        ];
    }
}
