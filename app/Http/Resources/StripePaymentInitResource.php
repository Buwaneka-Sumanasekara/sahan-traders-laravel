<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Helpers\convertToDisplayPrice;

class StripePaymentInitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      
  
        $resoruce=$this->resource;
        return [
            'sessionId' => $resoruce['sessionId'],
            'amount'=>$resoruce['amount'],
            'currency'=>config('setup.base_currency_id_stripe'),
            'amount_display'=> convertToDisplayPrice($resoruce['amount']/100),
        ];
    }
}
