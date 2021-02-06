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
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('stores', 'Admin\StoreController');
    Route::resource('products', 'Admin\ProductController');
    Route::resource('parsers', 'Admin\ParserController');
    Route::get('parsers/settings', 'Admin\ParserController@settings')->name('parsers.settings');
    Route::post('parsers/parse/{id}', 'Admin\ParserController@parseOne')->name('parsers.parse.one');
    Route::post('parsers/parse', 'Admin\ParserController@parseAll')->name('parsers.parse.all');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
