<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\CmCartHed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;
use App\CustomModels\CusModel_Product;
use App\Models\BmBuyerAddress;
use App\Models\CmCartDet;
use App\Models\StkmTrnSetup;
use Exception;

class CusModel_Cart extends Model
{
    /*=====================Helper functions===============================*/

    private function generateNextCartId()
    {
        $lastId = CmCartHed::max("id");
        $nextId = 1;
        if ($lastId) {
            $nextId = (int)$lastId + 1;
        }
        return "" . sprintf('%08d', $nextId);
    }
    private function getCartItemNo($cartId)
    {
        $lastId = CmCartDet::where('cm_cart_hed_id', $cartId)->max("id");
        $nextId = 1;
        if ($lastId) {
            $nextId = (int)$lastId + 1;
        }
        return $nextId;
    }

    /* ==============================  Get current cart   =========================================== */

    private function getCurrentCart($buyerId)
    {
        $cart = CmCartHed::where('bm_buyer_id', $buyerId)->where('cm_cart_status_id', config("global.cart_status.pending"))->first();
        return $cart;
    }

    private function createPendingCart($buyerId)
    {
        $cart = new CmCartHed();
        $cart->id = $this->generateNextCartId();
        $cart->gross_amount = 0;
        $cart->dis_per = 0;
        $cart->net_amount = 0;
        $cart->trn_date = now();
        $cart->stkm_trn_status_id = config("global.stk_trn_status.pending");
        $cart->stkm_trn_setup_id = config("global.trn_setup_types.Cart");
        $cart->trn_ref_no = "";
        $cart->bm_buyer_id = $buyerId;
        $cart->tax_per = 0;
        $cart->shipping_cost = 0;
        $cart->cm_cart_status_id = config("global.cart_status.pending");
        $cart->tracking_no = "";

        $cart->save();
        return $cart;
    }

    private function updateCartHedCalculations($cartId)
    {
        $cart = CmCartHed::find($cartId);

        $disPer = $cart->dis_per;

        $cart->gross_amount = CmCartDet::where('cm_cart_hed_id', $cartId)->sum('net_amount');

        $cart->net_amount = ($cart->gross_amount) - ($cart->gross_amount * $disPer / 100);
        $cart->save();

        if ($cart->buyer->hasShippingAddress()) {
            $this->updateCartHedShipping($cartId, $cart->buyer->shippingAddress);
        }
    }



    private function createCartItem($cartId, $product,$varientId, $qty)
    {
        $price = $product->getFIFOStockPrice($varientId);
        $amount = $price * $qty;

        $cartItem = new CmCartDet();
        $cartItem->id = $this->getCartItemNo($cartId);
        $cartItem->cprice = 0;
        $cartItem->sprice = $price;
        $cartItem->qty = $qty;
        $cartItem->free_qty = 0;
        $cartItem->line_dis_per = 0;
        $cartItem->line_dis_amt = 0;
        $cartItem->net_amount = $amount;

        $cartItem->pm_unit_group_id = $product->pm_unit_group_id;
        $cartItem->pm_unit_id =  $product->getDefaultSalesUnitId();

        $cartItem->cm_cart_hed_id = $cartId;
        $cartItem->pm_product_id = $product->id;
        $cartItem->stk_batch_id = $product->getFIFOStockId($varientId);

        $cartItem->save();


        $this->updateCartHedCalculations($cartId);

        return $cartItem;
    }

    public function isCheckQtyInTransaction()
    {
        return StkmTrnSetup::where("type", config("global.trn_setup_types.Cart"))->first()->en_check_qty;
    }


    /*============================== Cart Operation=======================================*/

    public function getCartItems($buyerId)
    {
        $cart = $this->getCurrentCart($buyerId);
        if (!$cart) {
            return [];
        }
        return CmCartDet::where('cm_cart_hed_id', $cart->id)->get();
    }


    /*============================ Cart functionalities ==============================================*/
    public function addItemToCart( $buyerId,$itemId,$varientId=1,$qty = 1): CmCartDet
    {
        $needToCheckQty = $this->isCheckQtyInTransaction();
        $cart = $this->getCurrentCart($buyerId);
        if (!$cart) {
            $cart = $this->createPendingCart($buyerId);
        }

        $product = CusModel_Product::getCartProductById($itemId);
        if (!$product) {
            return new Exception("Product not found");
        }
        if ($needToCheckQty && $product->isQtyAvailableInStock($qty)) {
            return new Exception("Product is out of stock");
        }

        return $this->createCartItem($cart->id, $product,$varientId, $qty);
    }

    public function removeItemFromCart($itemId, $buyerId)
    {
        $cart = $this->getCurrentCart($buyerId);
        if (!$cart) {
            return new Exception("Cart not found");
        }
        $cartItem = CmCartDet::where('cm_cart_hed_id', $cart->id)->where('pm_product_id', $itemId)->first();
        if (!$cartItem) {
            return new Exception("Cart item not found");
        }
        $cartItem->delete();
        $this->updateCartHedCalculations($cart->id);
    }

    public function updateItemInCart($itemId, $buyerId, $qty = 1): CmCartDet
    {
        $needToCheckQty = $this->isCheckQtyInTransaction();
        $cart = $this->getCurrentCart($buyerId);
        if (!$cart) {
            return new Exception("Cart not found");
        }
        $cartItem = CmCartDet::where('cm_cart_hed_id', $cart->id)->where('pm_product_id', $itemId)->first();
        if (!$cartItem) {
            return new Exception("Cart item not found");
        }
        $product = $cartItem->product;
        if ($needToCheckQty && $product->isQtyAvailableInStock($qty)) {
            return new Exception("Product is out of stock");
        }

        $cartItem->qty = $qty;
        $cartItem->save();
        $this->updateCartHedCalculations($cart->id);
        return $cartItem;
    }

    /*=========================Calculate shipping====================================*/
    private function updateCartHedShipping(string $cartId, BmBuyerAddress $address)
    {
        $cartItems = CmCartDet::where('cm_cart_hed_id', $cartId)->get();

        $shippingCost = 0;
    }
}
