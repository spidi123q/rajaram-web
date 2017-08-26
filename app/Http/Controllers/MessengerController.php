<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    function verify(Request $request){

        if($request->get('hub_verify_token') === 'rajaram'){
            echo $request->get('hub_challenge');
        }
        else{
            echo 'Error : invalid access';
        }
    }

    function setClientUrl(Request $request){
        session(['CLIENT_URL' => $request->get('url')]);
        return ['url' => session('CLIENT_URL')];
    }

    function onMessage(Request $request){

        $client = new Client();
        $response = $client->request('POST', session('CLIENT_URL').'/messenger', [
            'json' => json_encode($request->all())
        ]);
        return $response->getBody();
    }
}
