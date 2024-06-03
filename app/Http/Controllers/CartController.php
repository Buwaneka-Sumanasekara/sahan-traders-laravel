<?php

namespace App\Http\Controllers;

use App\CustomModels\CusModel_Cart;
use App\CustomModels\CusModel_Cart_Payments;
use App\CustomModels\CusModel_Payments;
use App\CustomModels\CusModel_ShipAndCoRates;
use App\Exceptions\AuthenticationException;
use App\Exceptions\EmailNotVerifiedException;
use App\Http\Resources\CartResource;
use App\Http\Resources\CommonResponseResource;
use App\Http\Resources\CountryCollectionResource;
use App\Http\Resources\ErrorResource;
use App\Models\CdmCountry;
use App\Models\CmCartHed;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CartController extends Controller implements HasMiddleware
{
    /**
     * Instantiate a new VerificationController instance.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'api_getCurrentCart'
    //     ]);
    // }

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except:['api_getCurrentCart']),
        ];
    }

    public function cart(Request $request)
    {
        return view('pages.general.cart');
    }



    /* ============================ API ============================================ */

    public function api_getCurrentCart(Request $request)
    {
        try {
            if (!!$request->user()) {
                $user_id = $request->user()->id;

                $cartHed = CusModel_Cart::getActiveCartHedByUserId($user_id);
                if ($cartHed !== null) {
                    return (new CommonResponseResource(new CartResource($cartHed)));
                } else {
                    $cartHed = new CmCartHed();
                    return (new CommonResponseResource(new CartResource($cartHed)));
                }
            } else {
                throw new AuthenticationException();
            }
        } catch (\Exception $e) {
            $cartHed = new CmCartHed();
            return (new CommonResponseResource(new CartResource($cartHed)));
        }
    }

    public function api_addToCart(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $productId = $request->string('productId')->trim();
                $stockId = $request->string('stockId')->trim();
                $variantId = $request->string('variantId')->trim();
                $qty = $request->float('qty');
                $unitGroupId = $request->string('unitGroupId')->trim();
                $unitId = $request->string('unitId')->trim();
                $additionalCostId = $request->string('additionalCostId')->trim();

                $isIncrementingQty = $request->boolean('isIncrementingQty');


                $cart = new \App\CustomModels\CusModel_Cart();
                $cart->user_id = $request->user()->id;
                $cart->ar_cart_items = array([
                    "product_id" => $productId,
                    "stock_id" => $stockId,
                    "variant_id" => $variantId,
                    "qty" => $qty,
                    "additional_cost_id" => $additionalCostId,
                    "unit_group_id" => $unitGroupId,
                    "unit_id" => $unitId
                ]);

                $cart->addToCart($isIncrementingQty);

                return (new CommonResponseResource([
                    "status" => "success"
                ]));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

    public function api_updateCartItem(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $cartDetId = $request->string('id')->trim();
                $qty = $request->float('qty');
                $unitGroupId = $request->string('unitGroupId')->trim();
                $unitId = $request->string('unitId')->trim();


                $cart = new \App\CustomModels\CusModel_Cart();
                $cart->user_id = $request->user()->id;
                $cart->ar_cart_items = array([
                    "id" => $cartDetId,
                    "qty" => $qty,
                    "unit_group_id" => $unitGroupId,
                    "unit_id" => $unitId
                ]);

                $cart->updateCartLine();

                return (new CommonResponseResource([
                    "status" => "success"
                ]));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

    public function api_deleteCartItem(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $cartDetId = $request->string('id')->trim();

                $cart = new \App\CustomModels\CusModel_Cart();
                $cart->user_id = $request->user()->id;
                $cart->ar_cart_items = array([
                    "id" => $cartDetId
                ]);

                $cart->deleteCartLine();

                return (new CommonResponseResource([
                    "status" => "success"
                ]));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

    public function api_getShippingRatesForCurrentCart(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $user_id = $request->user()->id;

                $cartHed = CusModel_Cart::getActiveCartHedByUserId($user_id);
                $shipAndCo=new CusModel_ShipAndCoRates();
                return $shipAndCo->getShippingCarriersRateList($cartHed, $cartHed->cartDetItems);
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

    //======================= Ship and co ==================================

    public function api_getShippingCarriers(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $shipAndCo=new CusModel_ShipAndCoRates();
                return $shipAndCo->getShippingCarriersList();
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

    public function api_changeShippingCarrier(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $carrierId = $request->string('carrierId')->trim();

                $user_id = $request->user()->id;

                $cartHed = CusModel_Cart::getActiveCartHedByUserId($user_id);
                $cartModel=new CusModel_Cart();
                
                $cartModel->updateShippingCarrier($carrierId,$cartHed);

                return (new CommonResponseResource([
                    "status" => "success"
                ]));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

    public function api_getAvilableCountries(Request $request)
    {

        try {
            if ($request->user()->hasVerifiedEmail()) {
                $countries= CdmCountry::where("active",1)->get();
                return (new CountryCollectionResource($countries));
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }

    }
    


 //======================= Payment ==================================
    public function api_generate_cart_payment_session_url(Request $request,$cartId)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $cartId = $cartId?$cartId:$request->input('cartId')->trim();

               
                $cartPay = new CusModel_Payments();
                return $cartPay->generatePaymentLink(config("global.payment_link_type.cart"),$cartId);

            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }

}
