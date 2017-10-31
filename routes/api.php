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

Route::group(['prefix' => 'auth', 'namespace' => 'API'], function () {
    Route::post('register', 'RegisterController@userRegistration');
    Route::post('login', 'LoginController@login');
});

Route::group(['middleware' => 'auth:api', 'prefix'=>'data', 'namespace' => 'API'], function () {
    Route::get('test', function (){
        return 1;
    });
});
//
Route::group(['prefix' => 'public', 'namespace' => 'API'], function () {
    Route::get('getCoinInfo/{coinName}', 'CoinsPublicData@getCoinInfo');
    Route::get('getTickerInfo/{coinName}', 'CoinsPublicData@getTickerInfo');
    Route::get('getOHLC/{coinName}', 'CoinsPublicData@getOHLC');
});