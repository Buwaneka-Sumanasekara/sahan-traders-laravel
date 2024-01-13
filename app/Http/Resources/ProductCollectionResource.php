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
            'data'=> $this->collection->map(fn (PmProduct $prod) => new ProductResource($prod))
        ];
    }

}
