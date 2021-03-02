<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/products', 'Api\V1\ProductController@index');
Route::get('/products', 'Api\V1\CatalogProductController@index');
Route::get('/stores', 'Api\V1\StoreController@index');
Route::get('/categories', 'Api\V1\CategoryController@index');
Route::get('/categories/{category}/products', 'Api\V1\ProductController@getByCategory');
Route::post('/filtering', 'Api\V1\ProductController@filteringProducts')->name('api.filtering');

Route::post('/cart', 'Api\V1\CartController@store');
Route::post('/cart/get', 'Api\V1\CartController@index');
Route::post('/cart/add', 'Api\V1\CartProductController@store');
Route::put('/cart/quantity/{quantity}/product/{product_id}', 'Api\V1\CartProductController@updateQuantity');
Route::delete('/cart/delete/{product_id}', 'Api\V1\CartProductController@delete');

Route::post('/order', 'Api\V1\OrderController@store');
Route::post('/order/get', 'Api\V1\OrderController@index');
