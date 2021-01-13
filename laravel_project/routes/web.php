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
use App\Item;

Auth::routes();

Route::get('/', function () {
	    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/item', 'ItemController@index')->name('item.index');

Route::get('item/detail/{id}', 'ItemController@show')->name('item.show');
