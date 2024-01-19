<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\CmCartHed;
use App\Models\CmCartDet;
use App\Models\BmBuyer;
use App\Models\PmProductAdditionalCost;

use Illuminate\Support\Facades\DB;


class CusModel_Cart extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'bm_buyer_id',
        'ar_cart_items', //array
    ];


    /*===========================Helper functions===========================================*/

    private function generateNextCartId()
    {
        $prefix = "";
        $lastId = CmCartHed::max("id");
        if ($lastId) {
            $lastNo = preg_replace("/[^0-9\.]/", '', $lastId);
            return $prefix . "" . sprintf('%08d', $lastNo + 1);
        } else {
            return $prefix . "00000001";
        }
    }
    private function generateNextCartItemId(string $cartId)
    {
        $lastId = CmCartDet::where('cm_cart_hed_id', $cartId)->max("id");
        if ($lastId) {
            return $lastId + 1;
        } else {
            return 1;
        }
    }


    // ======================== Getters ====================================
    private function getCartItemById(string $cartHedId, string $id)
    {
        return CmCartDet::where('cm_cart_hed_id', $cartHedId)->where('id', $id)->first();
    }

    private function getActiveCartHedByBuyerId(string $buyerId)
    {
        return CmCartHed::where('bm_buyer_id', $buyerId)->where('cm_cart_status_id', config('global.cart_status.pending'))->first();
    }

    private function getActiveCartDetByProductIdAndHedId(
        string $cartHedId,
        string $productId,
        string $stockId,
        string $variantId
    ) {
        return CmCartDet::where('cm_cart_hed_id', $cartHedId)
            ->where('product_id', $productId)
            ->where('pm_product_variant_id', $variantId)
            ->where('stk_batch_id', $stockId)
            ->first();
    }

    private function getAddressFromBuyer(BmBuyer $buyer, string $addressType)
    {
        if ($addressType == "shipping") {
            return $buyer->shippingAddress;
        } else if ($addressType == "billing") {
            return $buyer->billingAddress;
        } else {
            throw new \Exception("Invalid address type");
        }
    }


    //===========================GET functions : all items ===========================================

    public static  function getActiveCartHedByUserId(string $userId)
    {
        $buyer = BmBuyer::find($userId);
        $cartHed = CmCartHed::where('bm_buyer_id', $buyer->id)->where('cm_cart_status_id', config('global.cart_status.pending'))->first();
        return $cartHed;
    }

    //===========================CRUD functions : one item ===========================================

    private function deleteCartItem(string $cartHedId, string $id)
    {
        return CmCartDet::where('cm_cart_hed_id', $cartHedId)->where('id', $id)->delete();
    }

    private function calculateTotalAmount(string $cartHedId)
    {
        $cartHed = CmCartHed::find($cartHedId);
        $cartDets = CmCartDet::where('cm_cart_hed_id', $cartHedId)->get();


        $taxPer = 0;
        $isEnableTax = config("setup.en_tax");
        if ($isEnableTax) {
            $taxPer = config("setup.tax_per");
        }

        $totalAmount = 0;
        $taxAmount = 0;
        foreach ($cartDets as $cartDet) {
            $totalAmount += $cartDet->amount;
            if($cartDet->is_taxable_item){
                $taxAmount += ($cartDet->amount * $taxPer / 100);
            }
        }

        $cartHed->tax_per = $taxPer;
        $cartHed->tax_amount = $taxAmount;


        $disPer = isset($cartHed->dis_per) ? $cartHed->dis_per : 0;


        $cartHed->gross_amount = $totalAmount;

        //Tax will be calculate to gross amount
        $netAmount = $totalAmount - ($totalAmount * $disPer / 100) + $taxAmount;

        $cartHed->net_amount = $netAmount;
        $cartHed->update();
    }




    private function createCartHed(BmBuyer $buyer)
    {
        $cartHedId = $this->generateNextCartId();

        $buyerBillAddress = $this->getAddressFromBuyer($buyer, "billing");
        $buyerShipAddress = $this->getAddressFromBuyer($buyer, "shipping");


        $cartHed = new CmCartHed;

        $cartHed->id = $cartHedId;
        $cartHed->bm_buyer_id = $buyer->id;
        $cartHed->cm_cart_status_id = config('global.cart_status.pending');
        $cartHed->cr_by_user_id = $buyer->user_id;
        $cartHed->md_by_user_id = $buyer->user_id;
        $cartHed->trn_date = now();
        $cartHed->stkm_trn_status_id = config('global.stk_trn_status.pending');
        $cartHed->stkm_trn_setup_id = config('global.trn_setup_id.cart');
        $cartHed->trn_ref_no = "";
        $cartHed->gross_amount = 0;
        if (config("setup.en_tax")) {
            $cartHed->tax_per = config("setup.tax_per");
        } else {
            $cartHed->tax_per = 0;
        }
        $cartHed->tax_amount = 0;

        $cartHed->tracking_no = "";
        $cartHed->shipping_cost = 0;
        $cartHed->dis_per = 0;
        $cartHed->net_amount = 0;
        $cartHed->ship_address = (isset($buyerShipAddress) ? $buyerShipAddress->toJSON() : null);
        $cartHed->ship_address_country_id = (isset($buyerShipAddress) ? $buyerShipAddress->cdm_country_id : null);
        $cartHed->bill_address = (isset($buyerBillAddress) ? $buyerBillAddress->toJSON() : null);
        $cartHed->bill_address_country_id = (isset($buyerBillAddress->cdm_country_id) ? $buyerBillAddress->cdm_country_id : null);
        $cartHed->save();

        return $cartHedId;
    }




    /*===========================Public functions ================================================================*/
    public function updateCartHedAddress(BmBuyer $buyer)
    {
        $cartHed = $this->getActiveCartHedByBuyerId($buyer->id);

        $buyerBillAddress = $this->getAddressFromBuyer($buyer, "billing");
        $buyerShipAddress = $this->getAddressFromBuyer($buyer, "shipping");

        $cartHed->ship_address = (isset($buyerShipAddress) ? $buyerShipAddress->toJSON() : null);
        $cartHed->ship_address_country_id = (isset($buyerShipAddress) ? $buyerShipAddress->cdm_country_id : null);
        $cartHed->bill_address = (isset($buyerBillAddress) ? $buyerBillAddress->toJSON() : null);
        $cartHed->bill_address_country_id = (isset($buyerBillAddress->cdm_country_id) ? $buyerBillAddress->cdm_country_id : null);
        $cartHed->update();
    }

    public function deleteCartLine(){
        DB::beginTransaction();
        try {
            $buyer = BmBuyer::find($this->user_id);
            $cartHed = $this->getActiveCartHedByBuyerId($buyer->id);

            $cartHedId = "";
            if ($cartHed !== null) {
                $cartHedId = $cartHed->id;
            } else {
                throw new \Exception("Cart not found");
            }
            $arCartItems = isset($this->ar_cart_items) ? $this->ar_cart_items : [];

            foreach ($arCartItems as $cartItem) {
                $cartItemId = $cartItem['id'];
                $isDeleted = $this->deleteCartItem($cartHedId, $cartItemId);
               
                if(!$isDeleted){
                    throw new \Exception("Cart item not deleted");
                }
            }
            DB::commit();
            $this->calculateTotalAmount($cartHedId);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateCartLine(){
        DB::beginTransaction();
        try {
            $buyer = BmBuyer::find($this->user_id);

            if ($buyer === null) {
                throw new \Exception("You are not a buyer");
            }
            $cartHed = $this->getActiveCartHedByBuyerId($buyer->id);

            $cartHedId = "";
            if ($cartHed !== null) {
                $cartHedId = $cartHed->id;
            } else {
                throw new \Exception("Cart not found");
            }

            $arCartItems = isset($this->ar_cart_items) ? $this->ar_cart_items : [];

            foreach ($arCartItems as $cartItem) {
                $cartItemId = $cartItem['id'];
                $qty = $cartItem['qty'];

                $cartDet = $this->getCartItemById($cartHedId, $cartItemId);

                if ($cartDet === null) {
                    throw new \Exception("Cart item not found");
                }

                $lineDisPer = isset($cartDet->line_dis_per) ? $cartDet->line_dis_per : 0;
                $lineDisAmt = isset($cartDet->line_dis_amt) ? $cartDet->line_dis_amt : 0;

                //check stock qty
                $productId=$cartDet->product_id;
                $product = CusModel_Product::getCartProductById($productId);
                $stockId = $cartDet->stk_batch_id;
                $variantId = $cartDet->pm_product_variant_id;

                if (!$product->isQtyAvailableInStock($stockId, $variantId, $qty)) {
                    throw new \Exception("Product is out of stock");
                }

                $cartDet->qty = $qty;
                $cartDet->line_dis_per = $lineDisPer;
                $cartDet->line_dis_amt = $lineDisAmt;

                $temAmount = $cartDet->sprice * $qty;

                $cartDet->amount = $temAmount - ($lineDisAmt + ($temAmount * $lineDisPer / 100));
                $cartDet->update();
            }

            DB::commit();

            $this->calculateTotalAmount($cartHedId);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function addToCart(bool $isIncrementingQty)
    {
        DB::beginTransaction();
        try {
            $buyer = BmBuyer::find($this->user_id);

            if ($buyer === null) {
                throw new \Exception("You are not a buyer");
            }
            $cartHed = $this->getActiveCartHedByBuyerId($buyer->id);

            $cartHedId = "";
            if ($cartHed !== null) {
                $cartHedId = $cartHed->id;
            } else {
                $cartHedId=$this->createCartHed($buyer);
            }

            $arCartItems = isset($this->ar_cart_items) ? $this->ar_cart_items : [];

            foreach ($arCartItems as $cartItem) {
                $productId = $cartItem['product_id'];
                $stockId = $cartItem['stock_id'];
                $variantId = $cartItem['variant_id'];

                $product = CusModel_Product::getCartProductById($productId);

                if ($product === null) {
                    throw new \Exception("Product not found");
                }

                $cartDet = $this->getActiveCartDetByProductIdAndHedId($cartHedId, $productId, $stockId, $variantId);

                $qty = $cartItem['qty'];

                if ($cartDet !== null && $isIncrementingQty) {
                    $qty = $cartDet->qty + $qty;
                } else {
                    $qty = $qty;
                }

                if (!$product->isQtyAvailableInStock($stockId, $variantId, $qty)) {
                    throw new \Exception("Product is out of stock");
                }


                //Check existing Cart det

                $additionalCostId = isset($cartItem['additional_cost_id']) ? $cartItem['additional_cost_id'] : null;

                $additionalCost = null;

                if ($additionalCostId !== null) {
                    $additionalCost = PmProductAdditionalCost::find($additionalCostId);
                }


                if ($cartDet !== null) { //has item
                    $cartDet->qty = $qty;

                    $temAmount = $cartDet->sprice * $qty;

                    if ($additionalCost !== null) {
                        $cartDet->additional_product_cost_id = $additionalCost->id;
                        $cartDet->additional_product_cost = $additionalCost->amount;
                    }

                    $cartDet->amount = $temAmount - ($cartDet->line_dis_amt + ($temAmount * $cartDet->line_dis_per / 100));
                    $cartDet->update();
                } else {

                    $unitGroupId = $cartItem['unit_group_id'];
                    $unitId = $cartItem['unit_id'];

                    $sellPrice = $product->getSellPrice($stockId, $variantId);
                    $costPrice = $product->getCostPrice($stockId, $variantId);


                    $cartItemId = $this->generateNextCartItemId($cartHedId);

                    $cartDet = new CmCartDet;

                    $cartDet->id = $cartItemId;
                    $cartDet->cprice = $costPrice;
                    $cartDet->sprice = $sellPrice;
                    $cartDet->qty = $qty;
                    $cartDet->free_qty = 0;
                    $cartDet->line_dis_per = 0;
                    $cartDet->line_dis_amt = 0;
                    $cartDet->amount = $sellPrice * $qty;
                    $cartDet->pm_unit_group_id = $unitGroupId;
                    $cartDet->pm_unit_id = $unitId;
                    $cartDet->cm_cart_hed_id = $cartHedId;
                    $cartDet->product_id = $productId;
                    $cartDet->stk_batch_id = $stockId;
                    $cartDet->pm_product_variant_id = $variantId;
                    $cartDet->pm_product_variant_group_id = $product->pm_product_variant_group_id;

                    if ($additionalCost !== null) {
                        $cartDet->additional_product_cost_id = $additionalCost->id;
                        $cartDet->additional_product_cost = $additionalCost->amount;
                    }

                    $cartDet->save();
                }
            }

            DB::commit();

            $this->calculateTotalAmount($cartHedId);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
