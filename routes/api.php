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

Route::post('v1/access/token', 'MpesaController@generateAccessToken');
Route::post('/v1/hlab/stk/push', 'MpesaController@customerMpesaSTKPush');


Route::post('/v1/validation', 'Transactions@Validation');
Route::post('/v1/transaction/confirmation', 'Transactions@Confirmation');


Route::post('v1/hlab/register/url', 'Transactions@RegisterUrls');


Route::post('/school/new/access/token', 'Transactions@generateAccessToken');
Route::post('/school/stk/push','Transactions@customerSTKPush');
Route::post('/school/stk/push/callback/url', 'Transactions@Confirmation');