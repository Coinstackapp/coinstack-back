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
use Pepijnolivier\Kraken\ClientContract;
use Pepijnolivier\Kraken\Client;
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

//return $client->getAssetPairs(array('altname'=>'BCH'));
Route::get('getCoinInfo', function (){
    $client = new Client();
    $pair_name = [
        'altname'=>'XBTUSD'
    ];
    return 1;
    //return $client->getAssetPairs($pair_name);
});