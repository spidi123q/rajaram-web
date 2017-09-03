<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    function fileUpload(Request $request){

        $path = Storage::putFile('public',$request->file('upload_file'),'public');
        return $path;
    }

    function getFile(Request $request){
        $path = $request->get('filename');
        $file = pathinfo($path);
        $contents = Storage::get($path);
        $name = $file['filename'].'.'.$request->get('ext');

        return response($contents,200,[
            'Content-Type' => 'binary/octet-stream',
            'Content-Disposition' => "attachment; filename='{$name}'",
            'Accept-Ranges' => 'bytes'
        ]);

    }

    function saveUrl(Request $request){
        Storage::put('url.txt', $request->get('url'), 'private');
        $contents = Storage::get('url.txt');
        return ['url' => $contents];
    }

    function getCWD(){
        return getcwd();
    }
}
