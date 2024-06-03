<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StripePaymentIntentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource=$this->resource;
        return [
            'clientSecret' => $resource->client_secret,
            'successUrl'=>$resource->urls['success'],
            'cancelUrl'=>$resource->urls['cancel'],
            "billingAddress"=>$resource->billing_address,
        ];
    }
}
