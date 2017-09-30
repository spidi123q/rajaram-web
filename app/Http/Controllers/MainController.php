<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    function getRobotUrl(Request $request){

        $url = Storage::get('url.txt');
        return $url;
    }
}
