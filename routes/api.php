<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {

    //Units
    Route::get('units.search', 'UnitController@search');
    Route::post('units.store', 'UnitController@store');
    Route::post('units.{id}.update', 'UnitController@update');
    Route::delete('units.{id}.delete', 'UnitController@destroy');

    //Product Type
    Route::get('ptypes.search', 'ProductTypeController@search');
    Route::post('ptypes.store', 'ProductTypeController@store');
    Route::post('ptypes.{id}.update', 'ProductTypeController@update');
    Route::delete('ptypes.{id}.delete', 'ProductTypeController@destroy');
});
