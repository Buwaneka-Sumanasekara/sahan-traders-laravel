<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomModels\CusModel_Product;

class ProductController extends Controller
{

    /**
     * Show the product page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function specificProductBySlugPage(Request $request, $slug)
    {
        $product = CusModel_Product::getProductBySlug($slug);
        if ($product == null) {
            return redirect()->route('home');
        } else {
            return view('pages.general.product-info', [
                'product_id' => $product->id
            ]);
        }
    }


    /**
     * api calls
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function api_getProductInfoForVarient(Request $request,$productId,$varientId)
    {
        
        $product = CusModel_Product::getProductById($productId);
        if ($product == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ]);
        } else {
             $price = $product->getDisplayPrice($varientId);
             $stockQty=$product->getAvailableStockQty($varientId);
             $stockBatch=$product->getFIFOStockId($varientId);
            return response()->json([
                'status' => 'success',
                'message' => 'product price for varient',
                'time'=>time(),
                'data' => [
                    'price' => $price,
                    'available_stock_qty'=>$stockQty,
                    'product_id' => $productId,
                    'varient_id' => $varientId,
                    'stock_batch'=>$stockBatch
                ]
            ]);
        }

    }

}
