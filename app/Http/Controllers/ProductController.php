<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomModels\CusModel_Product;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\CommonResponseResource;
use App\Http\Resources\CommonResponseCollectionResource;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Resources\ProductCollectionResource;

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
        try {
            $product = CusModel_Product::getProductById($productId);
            if ($product == null) {
                throw new ResourceNotFound("Product");
            } else {
                 $price = $product->getDisplayPrice($varientId);
                 $stockQty=$product->getAvailableStockQty($varientId);
                 $stockBatch=$product->getFIFOStockId($varientId);
                return new CommonResponseResource((object)array(
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_price' => $price,
                        'product_stock_qty' => $stockQty,
                        'product_stock_batch' => $stockBatch,
                ));
               
            }
        }  catch (\Exception $e) {
            return (new ErrorResource($e));
        }
        
       

    }

    public function api_getFeatureProducts(Request $request)
    {
        try {
            $pageSize = 10;
            if($request->has('page-size')) {
                $pageSize=$request->input('page-size');
            }
            $featuredProducts=CusModel_Product::getFeaturedProducts($pageSize);
            return new ProductCollectionResource($featuredProducts);
        } catch (\Exception $e) {
            return (new ErrorResource($e));
        }
        
    }

}
