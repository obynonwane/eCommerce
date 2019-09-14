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


Route::apiResource('user','API\UserController');
Route::apiResource('deposit','API\DepositController');
Route::apiResource('transaction','API\TransactionController');
Route::get('get_received','API\TransactionController@getReceived');
Route::get('findUser','API\UserController@search');