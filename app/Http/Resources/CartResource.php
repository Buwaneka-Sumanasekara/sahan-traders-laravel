<?php

namespace App\Http\Resources;

use App\Models\CmCartDet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
            if(!isset($this->id)){
                return [
                    'hed'=>[
                        'id'=>"",
                        'userId'=>$this->user_id,
                        'grossAmount'=>0,
                        'disPer'=>0,
                        'netAmount'=>0,
                        'createdAt'=>now(),
                        'updatedAt'=>now(),
                        'itemsCount'=>$this->cartDetItems()->count(),
                        'displayNetAmount'=>$this->totalNetAmountDisplay(),
                       
                    ],
                    'det'=>[],
                ];
            }else{
            return [
                'hed'=>[
                    'id'=>$this->id,
                    'userId'=>$this->user_id,
                    'grossAmount'=>$this->gross_amount,
                    'disPer'=>$this->dis_per,
                    'netAmount'=>$this->net_amount,
                    'createdAt'=>$this->created_at,
                    'updatedAt'=>$this->updated_at,
                    'itemsCount'=>$this->cartDetItems()->count(),
                    'displayGrossAmount'=>$this->totalGrossAmountDisplay(),
                    'displayDisPer'=>$this->dis_per.'%',
                    'displayDisPerAmount'=>$this->discountPerAmountDisplay(),
                    'displayTaxPer'=>$this->tax_per.'%',
                    'displayTaxAmount'=>$this->taxAmountDisplay(),
                    'displayNetAmount'=>$this->totalNetAmountDisplay(),
                    'displayShippingCost'=>$this->shippingCostDisplay(),
                    'hasShippingAddress'=>$this->hasShippingAddress(),
                    'shippingAddress'=>$this->getShippingAddress(),
                    'shippingAddressCountry'=>new CountryResource($this->shippingAddressCountry),
                    'billingAddress'=>$this->getBillingAddress(),
                    'billingAddressCountry'=>new CountryResource($this->billingAddressCountry),
                    'carrierInfo'=>$this->getCarrierInfo(),
                ],
                'det'=>$this->cartDetItems()->get()->map(fn (CmCartDet $item) => new CartItemResource($item)),
            ];
        }
      
    }
}
