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
/*
auth認証時
*/
Auth::routes();

/*
User認証外
 */
Route::get('/item', 'ItemController@index')->name('item.index');
Route::get('/item/detail/{id}', 'ItemController@show')->name('item.show');
Route::get('/', function() { return view('welcome'); })->name('welcome');
/*
User認証時
*/
Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
});

/*
Admin認証不要時
*/
Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admin/home'); });
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
	//Route::get('item/detail/{id}', 'Admin\ItemController@show')->name('admin.item.show');
	//Route::get('/item', 'Admin\ItemController@index')->name('admin.item.index');
});

/*
Admin認証後
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
	//デフォルトのURIを変えないといけないためここでSHOWの定義
	Route::get('item/detail/{id}', 'Admin\ItemController@show')->name('admin.item.detail');
	Route::resource('item', 'Admin\ItemController', [
		'except' => [
			'show'
		],
		'names' => [
			'create' => 'admin.item.create',
			'index' => 'admin.item.index',
			'store' => 'admin.item.store',
			'destroy' => 'admin.item.destory',
			'edit' => 'admin.item.edit',
			'update' => 'admin.item.update'
		],
		'parameters' => [
			'item' => 'id'
		]
	]);
});

