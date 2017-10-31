<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Pepijnolivier\Kraken\ClientContract;
use Pepijnolivier\Kraken\Client;

class CoinsPublicData extends Controller
{
    public function getCoinInfo(Request $request){
        $client = new Client();
        $pair_name = [
            'altname'=>(string)$request->coinName
        ];
        return $client->getAssetPairs($pair_name);
    }

    public function getTickerInfo(Request $request){
        $client = new Client();
        $pair_name = [
            'altname'=>(string)$request->coinName
        ];
        return $client->getTickers($pair_name);
    }

    public function getOHLC(Request $request){
        $client = new Client();
        $pair_name = [
            'altname'=>(string)$request->coinName
        ];
        return $client->getRecentSpreads((string)$request->coinName);
    }

}
