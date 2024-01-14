<?php

namespace App\Http\Resources;

use App\Models\CmCartDet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemCollectionResource extends JsonResource
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
            'data'=> $this->collection->map(fn (CmCartDet $item) => new CartItemResource($item))
        ];
    }
}
