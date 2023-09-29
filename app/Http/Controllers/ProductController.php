<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomModels\CusModel_Product;

class ProductController extends Controller
{

    /**
     * Resent verificaiton email to user.
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
}
