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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/users-table', 'UserController@tableSearch')->name('user.components.users-table')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
    Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
    Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
    Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
    Route::get('clients', ['as' => 'pages.clients', 'uses' => 'PageController@clients']);
    Route::get('products', ['as' => 'pages.products', 'uses' => 'PageController@products']);
    Route::get('sales', ['as' => 'pages.sales', 'uses' => 'PageController@sales']);
    Route::get('refunds', ['as' => 'pages.refunds', 'uses' => 'PageController@refunds']);
    Route::get('inventory', ['as' => 'pages.inventory', 'uses' => 'PageController@inventory']);
    Route::get('adjusment', ['as' => 'pages.adjusment', 'uses' => 'PageController@adjusment']);
    Route::get('corte', ['as' => 'corte', 'uses' => 'PageController@corte']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('user/modal-edit', ['as' => 'components.user-edit-modal', 'uses' => 'ComponentsController@userEditModal']);
    Route::get('client/modal-edit', ['as' => 'components.client-edit-modal', 'uses' => 'ComponentsController@clientEditModal']);
    Route::get('product/modal-edit', ['as' => 'components.product-edit-modal', 'uses' => 'ComponentsController@productEditModal']);
    Route::get('refund/modal-edit', ['as' => 'components.refund-edit-modal', 'uses' => 'ComponentsController@refundEditModal']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/update_separate', ['as' => 'profile.updateSeparate', 'uses' => 'ProfileController@updateSeparate']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::put('profile/password_separate', ['as' => 'profile.passwordSeparate', 'uses' => 'ProfileController@passwordSeparate']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('product', ['as' => 'product.edit', 'uses' => 'ProductosController@edit']);
    Route::put('product', ['as' => 'product.update', 'uses' => 'ProductosController@update']);
    Route::get('product/search', ['as' => 'product.search', 'uses' => 'ProductosController@search']);
    Route::get('product/searchw', ['as' => 'product.searchw', 'uses' => 'ProductosController@searchWithoutReload']);
	Route::put('product/password', ['as' => 'product.password', 'uses' => 'ProductosController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('client', ['as' => 'client.edit', 'uses' => 'ClienteController@edit']);
    Route::put('client', ['as' => 'client.update', 'uses' => 'ClienteController@update']);
    Route::get('client/search', ['as' => 'client.search', 'uses' => 'ClienteController@search']);
    Route::get('client/searchw', ['as' => 'client.searchw', 'uses' => 'ClienteController@searchWithoutReload']);
	Route::put('client/password', ['as' => 'client.password', 'uses' => 'ClienteController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('sale', ['as' => 'sale.edit', 'uses' => 'VentaController@edit']);
    Route::post('sale', ['as' => 'sale.pay', 'uses' => 'VentaController@pagar']);
    Route::put('sale/close', ['as' => 'sale.close', 'uses' => 'VentaController@cerrar']);
    Route::get('sale/search', ['as' => 'sale.search', 'uses' => 'VentaController@search']);
    Route::get('sale/searchw', ['as' => 'sale.searchw', 'uses' => 'VentaController@searchWithoutReload']);
	Route::post('sale/create', ['as' => 'sale.create', 'uses' => 'VentaController@addVenta']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('payment', ['as' => 'payment.edit', 'uses' => 'PagoController@edit']);
    Route::put('payment', ['as' => 'payment.update', 'uses' => 'PagoController@update']);
    Route::get('payment/search', ['as' => 'payment.search', 'uses' => 'PagoController@search']);
    Route::get('payment/searchw', ['as' => 'payment.searchw', 'uses' => 'PagoController@searchWithoutReload']);
	Route::post('payment/create', ['as' => 'payment.create', 'uses' => 'PagoController@addPago']);
});

Route::group(["namespace"=>"Auth"],function() {
    Route::post('user/register', ['as' => 'register-users', 'uses' => 'RegisterController@register']);
});
