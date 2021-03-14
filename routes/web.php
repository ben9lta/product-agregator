<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('react');
})->name('home');

// Auth routes
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();

// Pages routes
Route::get('/{url}', function ($url) {
    return view('react');
})->where(['url' => 'catalog|about|order/success']);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('stores', 'Admin\StoreController');
    Route::resource('products', 'Admin\ProductController');
    Route::resource('parsers', 'Admin\ParserController');
    Route::resource('orders', 'Admin\OrderController');
    Route::post('orders/{id}/active', 'Admin\OrderController@active')->name('orders.active');
    Route::get('parsers/settings', 'Admin\ParserController@settings')->name('parsers.settings');
    Route::post('parsers/parse/{id}', 'Admin\ParserController@parseOne')->name('parsers.parse.one');
    Route::post('parsers/parse', 'Admin\ParserController@parseAll')->name('parsers.parse.all');
});




//Route::get('/', function () {
//    return view('frontend.home');
//})->name('home');

//Route::group(['prefix' => 'catalog'], function () {
//    Route::get('/', 'CatalogController@index');
//    Route::get('/{page}', 'CatalogController@index');
//    Route::get('/category/{id}', 'CatalogController@byCategory');
//});
//
//Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
//    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
//    Route::resource('categories', 'Admin\CategoryController');
//    Route::resource('stores', 'Admin\StoreController');
//    Route::resource('products', 'Admin\ProductController');
//    Route::resource('parsers', 'Admin\ParserController');
//    Route::get('parsers/settings', 'Admin\ParserController@settings')->name('parsers.settings');
//    Route::post('parsers/parse/{id}', 'Admin\ParserController@parseOne')->name('parsers.parse.one');
//    Route::post('parsers/parse', 'Admin\ParserController@parseAll')->name('parsers.parse.all');
//});
//
//Auth::routes();
//
//Route::get('/cabinet', 'CabinetController@index')->name('cabinet');
