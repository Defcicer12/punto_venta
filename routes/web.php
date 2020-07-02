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
    Route::get('refund/table-search', ['as' => 'components.refund-table-search', 'uses' => 'ComponentsController@refundtableSearch']);
    Route::get('client/select', ['as' => 'components.client-select', 'uses' => 'ComponentsController@clientSelect']);
    Route::get('client/table', ['as' => 'components.client-table', 'uses' => 'ComponentsController@clientTable']);
    Route::post('client/select', ['as' => 'components.sale-totals', 'uses' => 'ComponentsController@saleTotals']);
    Route::get('product/table', ['as' => 'components.products-table', 'uses' => 'ComponentsController@productTable']);
    Route::post('order/client-fill', ['as' => 'components.client-fill', 'uses' => 'ComponentsController@clientFill']);
    Route::post('order/tecnico-fill', ['as' => 'components.tecnico-fill', 'uses' => 'ComponentsController@tecnicoFill']);
    Route::post('order/tecnico-diagnostico', ['as' => 'components.refund-diagnostico', 'uses' => 'ComponentsController@diagnosticoForm']);
    Route::post('order/tecnico-concluido', ['as' => 'components.refund-concluido', 'uses' => 'ComponentsController@concluidoForm']);
    Route::post('order/tecnico-close', ['as' => 'components.refund-close', 'uses' => 'ComponentsController@closeForm']);
    Route::post('order/table', ['as' => 'components.refund-table', 'uses' => 'ComponentsController@refundsTable']);
    Route::post('product/fill', ['as' => 'components.products-fill', 'uses' => 'ComponentsController@productsFill']);
    Route::post('product/orders-prods', ['as' => 'components.order-products-table', 'uses' => 'ComponentsController@ordersProducts']);
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
    Route::post('product', ['as' => 'product.create', 'uses' => 'ProductosController@addProducto']);
	Route::get('product/edit', ['as' => 'product.edit', 'uses' => 'ProductosController@edit']);
    Route::put('product/update', ['as' => 'product.update', 'uses' => 'ProductosController@update']);
    Route::get('product/search', ['as' => 'product.search', 'uses' => 'ProductosController@search']);
    Route::get('product/searchw', ['as' => 'product.searchw', 'uses' => 'ProductosController@searchWithoutReload']);
	Route::put('product/password', ['as' => 'product.password', 'uses' => 'ProductosController@password']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('orden', ['as' => 'orden.create', 'uses' => 'Orden_servicioController@addOrdenServicio']);
	Route::get('orden/edit', ['as' => 'orden.edit', 'uses' => 'Orden_servicioController@edit']);
    Route::put('orden/update', ['as' => 'orden.update', 'uses' => 'Orden_servicioController@update']);
    Route::get('orden/search', ['as' => 'orden.search', 'uses' => 'Orden_servicioController@search']);
    Route::get('orden/searchw', ['as' => 'orden.searchw', 'uses' => 'Orden_servicioController@searchWithoutReload']);
    Route::put('orden/diagnosticar', ['as' => 'orden.diagnosticar', 'uses' => 'Orden_servicioController@diagnosticar']);
    Route::put('orden/pendiente', ['as' => 'orden.pendiente', 'uses' => 'Orden_servicioController@pendiente']);
    Route::put('orden/reparacion', ['as' => 'orden.reparacion', 'uses' => 'Orden_servicioController@reparacion']);
    Route::put('orden/concluir', ['as' => 'orden.concluir', 'uses' => 'Orden_servicioController@concluir']);
    Route::put('orden/cerrar', ['as' => 'orden.cerrar', 'uses' => 'Orden_servicioController@cerrar']);
    Route::post('orden/insumo', ['as' => 'orden.insumo', 'uses' => 'Orden_insumoController@addOrdenInsumo']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('pdf/ticket-cliente/{id}', ['as' => 'ticket.cliente', 'uses' => 'PDFController@ticketCliente']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('client', ['as' => 'client.edit', 'uses' => 'ClienteController@edit']);
    Route::put('client', ['as' => 'client.update', 'uses' => 'ClienteController@update']);
    Route::get('client/search', ['as' => 'client.search', 'uses' => 'ClienteController@search']);
    Route::get('client/searchw', ['as' => 'client.searchw', 'uses' => 'ClienteController@searchWithoutReload']);
    Route::put('client/password', ['as' => 'client.password', 'uses' => 'ClienteController@password']);
    Route::post('client/create', ['as' => 'client.create', 'uses' => 'ClienteController@addCliente']);
    Route::put('client/update', ['as' => 'client.update', 'uses' => 'ClienteController@update']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('movement', ['as' => 'movement.edit', 'uses' => 'Movimiento_inventarioController@edit']);
    Route::put('movement', ['as' => 'movement.update', 'uses' => 'Movimiento_inventarioController@update']);
    Route::get('movement/search', ['as' => 'movement.search', 'uses' => 'Movimiento_inventarioController@search']);
    Route::get('movement/searchw', ['as' => 'movement.searchw', 'uses' => 'Movimiento_inventarioController@searchWithoutReload']);
    Route::put('movement/password', ['as' => 'movement.password', 'uses' => 'Movimiento_inventarioController@password']);
    Route::post('movement/create', ['as' => 'movement.create', 'uses' => 'Movimiento_inventarioController@addMovimiento']);
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
	Route::get('refund', ['as' => 'refund.edit', 'uses' => 'DevolucionController@edit']);
    Route::post('refund', ['as' => 'refund.pay', 'uses' => 'DevolucionController@pagar']);
    Route::put('refund/close', ['as' => 'refund.close', 'uses' => 'DevolucionController@cerrar']);
    Route::get('refund/search', ['as' => 'refund.search', 'uses' => 'DevolucionController@search']);
    Route::get('refund/searchw', ['as' => 'refund.searchw', 'uses' => 'DevolucionController@searchWithoutReload']);
	Route::post('refund/create', ['as' => 'refund.create', 'uses' => 'DevolucionController@addDevolucion']);
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
