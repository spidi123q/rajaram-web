<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    function fileUpload(Request $request){

        $path = Storage::putFile('public',$request->file('upload_file'));
        return $path;
    }

    function getFile(Request $request){
        $path = $request->get('filename');
        return response()->download($path);
    }
}
