<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomModels\CusModel_Product;
use App\Http\Resources\ErrorResource;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Resources\ProductCollectionResource;
use App\Http\Resources\ProductResource;

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

    public function api_getProductInfoForVarient(Request $request,$productId)
    {
        try {
            $product = CusModel_Product::getProductById($productId);
            if ($product == null) {
                throw new ResourceNotFoundException("Product not found");
            } else {
                //  $price = $product->getDisplayPrice($variantId);
                //  $stockQty=$product->getAvailableStockQty($variantId);
                //  $stockBatch=$product->getFIFOStockId($variantId);
                // return new CommonResponseResource((object)array(
                //         'product_id' => $product->id,
                //         'product_name' => $product->name,
                //         'product_price' => $price,
                //         'product_stock_qty' => $stockQty,
                //         'product_stock_batch' => $stockBatch,
                //         'is_inquiry_item'=>$product->is_inquiry_item,
                //         'unit_group_id'=>$product->pm_unit_group_id,
                //         'unit_id'=>$product->getDefaultSalesUnitId(),
                // ));

              

                return (new ProductResource($product));
               
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
