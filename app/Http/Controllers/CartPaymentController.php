<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CartPaymentController extends Controller implements HasMiddleware
{
    // Middleware 
    public static function middleware(): array
    {
        return [
           // new Middleware('auth', except:['cart_payment']),
        ];
    }

    // View
    public function cart_payment()
    {
        return view('pages.general.cart-payment');
    }


    /* ============================ API ============================================ */
}
