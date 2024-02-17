<?php

namespace App\Http\Resources;

use App\Models\CdmCountry;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryCollectionResource extends JsonResource
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
            'data'=> $this->map(fn (CdmCountry $item) => new CountryResource($item))
        ];
    }
}
