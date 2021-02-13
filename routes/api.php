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

Route::get('/products', 'Api\V1\ProductController@index');
Route::get('/stores', 'Api\V1\StoreController@index');
Route::get('/categories', 'Api\V1\CategoryController@index');
Route::get('/categories/{category}/products', 'Api\V1\ProductController@getByCategory');
Route::post('/filtering', 'Api\V1\ProductController@filteringProducts')->name('api.filtering');
