<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Uploader extends Controller
{
    public function index(Request $request)
    {
        if($request->hasFile('file'))
            $fichier = $request->file('file')->extension();
        return $fichier;
    }
}