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
            $productId = $request->string('productId')->trim();
            $stockId = $request->string('stockId')->trim();
            $varientId = $request->string('varientId')->trim();
            $qty = $request->float('qty');
            $unitGroupId=$request->string('unitGroupId')->trim();
            $unitId=$request->string('unitId')->trim();
            $additionalCostId=$request->string('additionalCostId')->trim();

            return response()
                ->json(['id' => $productId, 
                'qty' => $qty,
                'unitGroupId'=>$unitGroupId,
                'unitId'=>$unitId,
                'stockId'=>$stockId,
                'varientId'=>$varientId,
                'additionalCostId'=>$additionalCostId]);
        } else {
            $errorResponse = new ErrorResource(new EmailNotVerifiedException());
            return $errorResponse;
        }
    }
}
