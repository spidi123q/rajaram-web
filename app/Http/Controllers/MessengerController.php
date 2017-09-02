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

        $clientRobo = ClientRobo::find(1);
        $clientRobo->url = $request->get('url');
        $clientRobo->save();
        return ['url' => $request->get('url')];
    }

    function onMessage(Request $request){

        $clientRobo = ClientRobo::find(1);
        $client = new Client();
        $response = $client->request('POST', $clientRobo->url .'/messenger', [
            'json' => json_encode($request->all())
        ]);
        return $response->getBody();
    }

    function sendReply(Request $request){

        $client = new Client();
       $response = $client->request('POST', 'https://graph.facebook.com/v2.6/me/messages?access_token=EAACD8xUCDysBAIrjBZCiHpKnEZCNqJSYZCFlyZBunZCGcKuXvTHdZBeHqiRvr75fi5eZBfSqQjiV9OmtiZCE2gcF8WbuU8O9ad6ZBCTKY2b0MZA4vTiTyjGDFiZB6i5felF1zuTBDEgp9mKrhp8TjDkmHnOBzAXgjiIkOmZBl4zKVQbjZAXEPvc5Gdw1s', [
            'body' => json_encode($request->all()),
           'headers' => [
               'Content-Type'     => 'application/json',
           ]
        ]);
        return $response->getBody();

       //return json_encode($request->all());
    }
}
