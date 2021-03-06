<?php

namespace App\Http\Controllers;

use App\ClientRobo;
use GuzzleHttp\Client;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Psy\Exception\FatalErrorException;

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

    function onMessage(Request $request){

            try{
                $url = Storage::get('url.txt');
                $client = new Client();
                $response = $client->request('POST',  $url.'/messenger', [
                    'json' => json_encode($request->all())
                ]);

            }
            catch (\Exception $e){
                echo $e;
            }

        return response('Hello World', 200)
            ->header('Content-Type', 'text/plain');
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
