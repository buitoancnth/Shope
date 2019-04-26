<?php

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

Route::get('index',['as'=>'trang-chu', 'uses' => 'PageController@getIndex']);
Route::get('type-product',['as'=>'loai-san-pham', 'uses' => 'PageController@getTypeProduct']);
Route::get('product-detail', ['as' =>' product-detail', 'uses' => 'PageController@getAllProduct']);
Route::get('contacts', ['as' => 'contacts', 'uses' => 'PageController@getContacts']);
Route::get('login', ['as' => 'login', 'uses' => 'PageController@login']);
Route::get('pricing', ['as' => 'pricing', 'uses' => 'PageController@getPrice']);