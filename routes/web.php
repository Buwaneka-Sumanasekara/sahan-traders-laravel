<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'registerPage')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'loginPage')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});


// Define Custom Verification Routes
Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/product/{slug}', 'specificProductBySlugPage')->name('product.public.display');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'cartStep1')->name('cart.step1');
});



//local api
Route::prefix('web-api')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/{productId}', 'api_getProductInfoForVarient')->name('api.product.get-info-for-variant');
        Route::get('/feature-products', 'api_getFeatureProducts')->name('api.product.get-feature-products');
    });

    Route::controller(CartController::class)->group(function () {
        Route::prefix('cart')->group(function () {
            Route::get('/current', 'api_getCurrentCart')->name('api.cart.get-current-cart');
        });
    });

    Route::prefix('action')->group(function () {
        Route::controller(CartController::class)->group(function () {
            Route::prefix('cart')->group(function () {
                Route::prefix('item')->group(function () {
                    Route::post('/add', 'api_addToCart')->name('action.cart.item.add');
                    Route::put('/update', 'api_updateCartItem')->name('action.cart.item.update');
                    Route::post('/delete', 'api_deleteCartItem')->name('action.cart.item.delete');    
                });
            });
        });
    });
});
