<?php

namespace App\Http\Controllers;

use App\Models\fichiers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Monolog\Handler\ElasticsearchHandler;

class Uploader extends Controller
{ 
     public function index()
     {
          return view()
     }
    public function store(Request $request)
    {
               $departements = DB::table('departements')->get();
               
               if (request()->hasFile('fichier')) 
               {
                    // dd($request->fichier);
                    $date_courante = date('Y-m-d H:i:s'); 
                    $extenFileUpload = $request->fichier->getClientOriginalExtension();
                    $sizeFileUpload = $request->fichier->getSize(); 
                    $nameFileUpload = $request->fichier->getClientOriginalName(); 
                    
                    
                    $extensions = array('pdf', 'PDF', 'zip', 'ZIP');
                    foreach($extensions as $extension)
                    {
                         // conndition pour uploader un fichier
                        if($extension == $extenFileUpload) 
                        {
                             if($sizeFileUpload <= 500000)
                             {
                                   $path = $request->fichier->storeAs('myhintesp_public_doc', $request->user()->id);
                                   
                                   //  requête insertion d'un fichier dans la base de donnée
                                   DB::table('fichiers')->insert([
                                        'url_fichier' => $path,
                                        'nom_fichier' => $nameFileUpload,
                                        'size_fichier' => $sizeFileUpload,
                                        'user_id' => $request->user()->id,
                                        'matiere_id' => $request->matieres,
                                        'created_at' => $date_courante,
                                   ]);

                                   session()->flash('message_succes', 'fichier uploader avec succé !');
                                   return view('upload', compact('departements'));    
                             }
                             else
                             {
                                   session()->flash('message_danger', 'La taille de ce fichier n\'est pas autorisée ! '); // affichage de message d'erreur
                                   return view('upload', compact('departements'));    
                             }
  
                        }
                        else
                        {
                         session()->flash('message_danger', 'Seules les extensions \'zip\' ou \'pdf\' sont autorisées ! '); // affichage de message d'erreur
                         return view('upload', compact('departements')); 
                        }

                    }
               }
               else
               {
                    
                    return view('upload', compact('departements'));
               }
       
    }

    // fonction concernant le dropdown menu 
    public function getfiliere($id)
    {
               $filieres = DB::table('filieres')->where('departement_id', $id)->get();
               return  response()->json($filieres);
    }

    public function getmatiere($id)
    {
               $matieres = DB::table('matieres')->where('filiere_id', $id)->get();
               return  response()->json($matieres);
    }
}
