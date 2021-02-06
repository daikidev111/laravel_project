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
use App\Cart;
use Illuminate\Database\Eloquent\Model;
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


Route::get('/charge', 'ChargeController@index')->name('payment.index');
Route::post('/charge/pay', 'ChargeController@charge')->name('payment.pay');


/*
User認証時
*/
Route::group(['middleware' => 'auth:user'], function() {
	//home
	Route::get('/home', 'HomeController@index')->name('home');

	//Cart Routes
	Route::get('/cart', 'CartController@index')->name('cart.index');
	Route::DELETE('/cart/{item_id}', 'CartController@delete')->name('cart.delete');
	Route::post('/cart', 'CartController@add')->name('cart.add');

	//address routes
	Route::resource('address', 'AddressController', [
		'except' => [
			'show',
		],
		'names' => [
			'create' => 'address.create',
			'index' => 'address.index',
			'store' => 'address.store',
			'edit' => 'address.edit',
			'update' => 'address.update',
			'destroy' => 'address.delete',
		],
		'parameters' => [
			'address' => 'id'
		]
	]);

	//account routes
	Route::get('/account', 'Account\AccountController@show')->name('account.detail');
	Route::get('/account/edit_account', 'Account\AccountController@editAccount')->name('account.edit_account');
	Route::get('/account/reset_password', 'Account\AccountController@editPassword')->name('account.edit_password');

	//reset email
	Route::post('/email', 'Account\ChangeEmailController@sendChangeEmailLink')->name('account.send_mail');
	Route::get('/email/change/{token}', 'Account\ChangeEmailController@reset');

	//change password
	Route::post('/password/change', 'Account\ChangePasswordController@changePassword')->name('account.change_password');
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
	Route::get('account', 'Admin\AccountController@index')->name('admin.account.index');
	Route::get('account/detail/{id}', 'Admin\AccountController@detail')->name('admin.account.detail');
	//デフォルトのURIを変えないといけないためここでSHOWの定義
	Route::get('item/detail/{id}', 'Admin\ItemController@show')->name('admin.item.detail');
	Route::resource('item', 'Admin\ItemController', [
		'except' => [
			'show',
			'destroy'
		],
		'names' => [
			'create' => 'admin.item.create',
			'index' => 'admin.item.index',
			'store' => 'admin.item.store',
			'edit' => 'admin.item.edit',
			'update' => 'admin.item.update'
		],
		'parameters' => [
			'item' => 'id'
		]
	]);
});

