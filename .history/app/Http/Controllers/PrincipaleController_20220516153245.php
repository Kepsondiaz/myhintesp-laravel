<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrincipaleController extends Controller
{
        public function index(Request $request)
        {
            $users = DB::table('fichiers')->orderBy('created_at', 'desc')->get();
            $fichiers = DB::table('users')
            ->join('fichiers', 'users.id', '=', 'fichiers.user_id')
            ->select('users.name', 'fichiers.*')
            
            ->get();
            return view('dashboard', compact('fichiers'));
        }

}