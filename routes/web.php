<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('pages.general.home');
    });

    Route::get('/login', function () {
        return view('pages.general.login');
    });

    Route::get('/register', function () {
        return view('pages.general.register');
    });
});



Route::post('/action/login', [AuthController::class, 'login']);
Route::get('/action/logout', [AuthController::class, 'logout']);
