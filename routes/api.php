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
Route::get('/messenger','MessengerController@verify');
Route::get('/setClientUrl','MessengerController@setClientUrl');
Route::post('/sendReply','MessengerController@sendReply');
Route::post('/fileUpload','FileController@fileUpload');
Route::get('/getFile','FileController@getFile');
Route::get('/saveUrl','FileController@saveUrl');
Route::get('/getCWD','FileController@getCWD');
