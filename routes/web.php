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

Route::get('/index', '\App\Http\Controllers\ProductTypeController@setIndex');
Route::get('/list/{product_type_uuid?}/{order?}',  [
    'uses'  => '\App\Http\Controllers\ProductTypeController@getProductList', 
    'as'    => 'list'
]);
Route::get('/welcome', function () {
    return view('welcome');
});
