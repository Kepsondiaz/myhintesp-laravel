<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrincipaleController extends Controller
{
        public function index(Request $request)
        {
k
            return view('dashboard', 
                // [ 'fichiers'=>DB::table('fichiers')->paginate(6) ]
            );
        }

}
