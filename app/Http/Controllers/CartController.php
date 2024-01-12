<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailNotVerifiedException;
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
        if ($request->user()->hasVerifiedEmail()) {
            $productId = $request->string('product_id')->trim();
            $stockId = $request->string('stock_id')->trim();
            $varientId = $request->string('varient_id')->trim();
            $qty = $request->float('qty');

            return response()
                ->json(['name' => $productId, 'qty' => $qty]);
        } else {
            $errorResponse = new ErrorResource(new EmailNotVerifiedException());
            return $errorResponse;
        }
    }
}
