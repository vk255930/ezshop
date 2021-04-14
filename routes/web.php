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

Route::get('/index', '\App\Http\Controllers\IndexController@getIndexView');
Route::get('/dashboard',  [
    'uses'  => '\App\Http\Controllers\DashboardController@getDashboardView', 
    'as'    => 'dashboard'
]);
Route::get('/list',  [
    'uses'  => '\App\Http\Controllers\ListController@getListView', 
    'as'    => 'list'
]);
Route::get('/post',  [
    'uses'  => '\App\Http\Controllers\PostController@getPostView', 
    'as'    => 'post'
]);
Route::post('/saveProduct', '\App\Http\Controllers\FormController@saveProduct');

