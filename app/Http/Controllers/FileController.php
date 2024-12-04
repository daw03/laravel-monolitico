<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download($filename){
        $path = public_path() . '/peticiones' . $filename;
        return $path;
    }
}
