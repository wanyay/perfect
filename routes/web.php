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

Route::get('/', 'HomeController@index');

Route::get('/test', function () {

});

Auth::routes();

Route::group(['middleware'=>[ 'auth', 'role:admin' ]], function () {

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('/units', 'UnitsController');

    Route::resource('/producttype', 'ProductTypeController');

    Route::resource('/customers', 'CustomerController');

    Route::resource('/suppliers', 'SupplierController');

    Route::resource('/items', 'ItemController');

    Route::get('/inventory/{id}', 'InventoryController@show');

    Route::get('/items/{id}/barcode', 'ItemController@barcode');

    Route::resource('/credit', 'CreditController');

    Route::get('/purchases/{id}/print', 'PurchaseController@print_out');

    Route::resource('/purchases', 'PurchaseController');

    Route::resource('/expenses', 'ExpenseController');

    Route::resource('/category', 'CategoryController');

    Route::get('/daily', 'ReportController@daily');

    Route::get('/dailys', 'ApiController\DailyApiController@daily');

    Route::post('/payback', 'CreditController@payback');

    Route::get('/monthly', 'ApiController\MonthlyApiController@getMonthlyForm');
});

Route::group(['middleware' => ['role:admin|seller']], function () {

    Route::resource('/sales', 'SaleController');

    Route::get('/sales/{sale}/print', 'InventoryController@printOut');
});
