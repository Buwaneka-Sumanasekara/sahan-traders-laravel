<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\PmProduct;

class ProductCollectionResource extends ResourceCollection
{
   /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'time'=>time(),
            'data'=> $this->collection->map(fn (PmProduct $prod) => [
                'id' => $prod->id,
                'name' => $prod->name,
                'slug' => $prod->slug,
                'isInquiryItem' => $prod->is_inquiry_item,
                'isQtyAvailableInStock'=>$prod->getIsDefaultQtyAvailableInTheStock(1),//default varient id is 1
                'mainThumbnailImageUrl' => $prod->mainThumbnailImageUrl(),
                'price'=>$prod->getDefaultVarientPrice(),
                'varientId'=>$prod->getDefaultProductVarient()->id,
                'stockId'=>$prod->getDefaultStockIdOfDefaultVarient(),
           ])
        ];
    }

}
