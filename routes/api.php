<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::get('/customers',"ApiController\CustomerApiController@getCustomer");
    Route::post('/customers',"ApiController\CustomerApiController@store");
    Route::get('/sale/items','ApiController\SaleApiController@getItems');
    Route::get('/purchase/items', 'ApiController\PurchaseApiController@getItems');
    Route::get('/saleitem/{id}','ApiController\SaleApiController@getSaleItem');
    Route::get('/purchaseitem/{id}','ApiController\PurchaseApiController@getPurchaseItem');
    Route::get('/suppliers',"ApiController\SupplierApiController@getSupplier");
    Route::post('/suppliers',"ApiController\SupplierApiController@store");
    Route::get('/daily/{date}',"ApiController\DailyApiController@dailychange");
    Route::post('/monthly',"ApiController\MonthlyApiController@getMonthlyData");
    
