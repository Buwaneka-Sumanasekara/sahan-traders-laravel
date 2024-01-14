<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailNotVerifiedException;
use App\Http\Resources\CommonResponseResource;
use App\Http\Resources\ErrorResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Instantiate a new VerificationController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $productId = $request->string('productId')->trim();
                $stockId = $request->string('stockId')->trim();
                $variantId = $request->string('variantId')->trim();
                $qty = $request->float('qty');
                $unitGroupId=$request->string('unitGroupId')->trim();
                $unitId=$request->string('unitId')->trim();
                $additionalCostId=$request->string('additionalCostId')->trim();
    
    
                $cart=new \App\CustomModels\CusModel_Cart();
                $cart->user_id=$request->user()->id;
                $cart->ar_cart_items=array([
                    "product_id"=>$productId,
                    "stock_id"=>$stockId,
                    "variant_id"=>$variantId,
                    "qty"=>$qty,
                    "additional_cost_id"=>$additionalCostId,
                    "unit_group_id"=>$unitGroupId,
                    "unit_id"=>$unitId
                ]);
    
                $cart->addToCart();
    
                return (new CommonResponseResource([
                    "status"=>"success"
                ]));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
      
    }
}
