<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class WebController extends Controller
{
    private $serviceAccount,$fireBase,$database;
    function __construct(){
        $this->serviceAccount = ServiceAccount::fromJsonFile(base_path() . '/rajaram-firebase.json');
        $this->fireBase = (new Factory)
            ->withServiceAccount($this->serviceAccount)
            ->create();
        $this->database = $this->fireBase->getDatabase()->getReference();
    }
    function getFbStream(){
        $data = $this->database->getChild('facebook')->getChild('live_stream')->getValue();
        return json_encode($data);
    }
}
