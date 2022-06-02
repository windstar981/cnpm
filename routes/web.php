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
Route::post('/addWishList',[App\Http\Controllers\WishlistController::class, 'store'])->name('addWishList');
Route::delete('/deleteWishList/{id}',[App\Http\Controllers\WishlistController::class, 'destroy'])->name('deleteFromWishList');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout',  [LoginController::class, 'logout'])->name('customer.logout');
Route::prefix('cart')->group(function () {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/addToCart',[App\Http\Controllers\CartController::class, 'store'])->name('addToCart');
    Route::delete('/deleteCart/{id}',[App\Http\Controllers\CartController::class, 'destroy'])->name('deleteFromCart');
    Route::PATCH('/updateCart',[App\Http\Controllers\CartController::class, 'update'])->name('updateCart');
});
Route::get('/checkout',[App\Http\Controllers\CheckOutController::class, 'index'])->name('checkout');
Route::POST('/saveOrder',[App\Http\Controllers\CheckOutController::class, 'store'])->name('saveOrder');


Route::group([
    'namespace' => 'App\Http\Controllers\Product',
    'prefix'    => '/product',
], function () {
    Route::get('/{slug}', 'ProductDetailController@index')->name('get.product.detail');
    Route::post('/rate/store', 'ProductDetailController@storeRate')->name('post.rate.store');
}
);

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth',
], function () {
    Route::get('/account', 'MyAccountController@account')->name('get.account.index');
    Route::post('/account/store', 'MyAccountController@storeInfo')->name('post.account.store');
    Route::get('/account/password', 'MyAccountController@password')->name('get.password.index');
    Route::post('/account/password/store', 'MyAccountController@changePassword')->name('post.password.store');

}

);

