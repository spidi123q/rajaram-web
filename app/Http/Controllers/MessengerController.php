<?php

namespace App\Http\Controllers;

use App\ClientRobo;
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

        $t = ClientRobo::all();
        return $t;
    }

    function onMessage(Request $request){
/*
        $client = new Client();
        $response = $client->request('POST', session('CLIENT_URL').'/messenger', [
            'json' => json_encode($request->all())
        ]);
*/
        return session('CLIENT_URL');
    }
}
