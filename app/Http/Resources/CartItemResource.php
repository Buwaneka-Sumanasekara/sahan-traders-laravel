<?php

namespace App\Http\Resources;

use App\Models\CmCartDet;
use App\Models\PmProductAdditionalCost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product=$this->product;
        $stock=$product->getStockByIdAndVariantId($this->stk_batch_id, $this->pm_product_variant_id);
        $additionalCost=isset($this->additional_product_cost_id)?PmProductAdditionalCost::find($this->additional_product_cost_id):null;
        return [
                'id'=>$this->id,
                'productId'=>$this->product_id,
                'stockId'=>$this->stk_batch_id,
                'variantId'=>$this->pm_product_variant_id,
                'qty'=>$this->qty,
                'amount'=>$this->amount,
                'unitGroupId'=>$this->unit_group_id,
                'unitId'=>$this->unit_id,
                'productName'=>$product->name,
                'productSlug'=>$product->slug,
                'productThumbnailImageUrl'=>$product->mainThumbnailImageUrl(),
                'displaySellPrice'=>$this->displaySellPrice(),
                'displayCostPrice'=>$this->displayCostPrice(),
                'additionalCostId'=>$this->additional_product_cost_id,
                'additionalCostDes'=> $additionalCost ? $additionalCost->name : "",
                'additionalCostAmount'=> $additionalCost ? $additionalCost->amount : 0,
                'lineDisPer'=> $this->line_dis_per,
                'lineDisAmt'=> $this->line_dis_amt,
                'displayAmount'=> $this->displayAmountPrice(),
                'hasPriceUpdate'=>($this->sprice !== $stock->sprice)   
        ];
    }
}
