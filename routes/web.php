<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout',  [LoginController::class, 'logout'])->name('customer.logout');
Route::get('/product/{slug}',  [App\Http\Controllers\Product\ProductController::class, 'show']);
Route::prefix('cart')->group(function () {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/addToCart',[App\Http\Controllers\CartController::class, 'store'])->name('addToCart');
    Route::delete('/deleteCart/{id}',[App\Http\Controllers\CartController::class, 'destroy'])->name('deleteFromCart');
    Route::get('/updateCart/{id}',[App\Http\Controllers\CartController::class, 'update'])->name('updateCart');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Product',
    'prefix'    => '/product',
], function () {
    Route::get('/{slug}', 'ProductDetailController@index')->name('get.product.detail');
}
);
