<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrincipaleController extends Controller
{
        public function index(Request $request)
        {
            $fichiers = DB::table('fichiers')
            ->join('matieres', 'matiere.id', '=', 'fichiers.user_id')
            ->select('users.name', 'fichiers.*')
            ->orderBy('created_at', 'desc')
            ->get();
            return view('dashboard', compact('fichiers'));
        }

}