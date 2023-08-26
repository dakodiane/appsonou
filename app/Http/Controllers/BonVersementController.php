<?php

namespace App\Http\Controllers;

use App\Models\BonVersement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BonVersementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $request->validate([
                'code' => 'required',
                'nom_deposant' => 'required',
                'objet_versement' => 'required',
                'motif_versement' => 'required',
                'montant' => 'required|numeric',
                'date_versement' => 'required|date', 
                'user_id' => 'required|exists:users,id',    

            ]);
            
            $bon = new BonVersement;
            $bon->code = $request->code;
            $bon->nom_deposant = $request->nom_deposant;
            $bon->objet_versement = $request->objet_versement;
            $bon->motif_versement = $request->motif_versement;
            $bon->montant = $request->montant;
            $bon->date_versement = $request->date_versement;
            $bon->user_id = 1;

            $bon->save();

            return response()->json(['message' => 'Bon de versement créé avec succès']);
           
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de lenregistrement du bon de versement.', $e], 500);
        }
       
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Recherchez le bon de caisse en fonction de son ID et du bénéficiaire
            $bon = BonVersement::where('id', $id)
                ->first();
            
            if (!$bon) {
                return response()->json(['message' => 'Bon de Versement introuvable'], 404);
            }
            
            // Mettez à jour les attributs du bon de Versement en fonction de la demande
          
            $bon->code = $request->code;
            $bon->nom_deposant = $request->nom_deposant;
            $bon->objet_versement = $request->objet_versement;
            $bon->motif_versement = $request->motif_versement;
            $bon->montant = $request->montant;
            
        
            $bon->save();
        
            return response()->json(['message' => 'Bon de versement mis à jour avec succès']);
        } catch (\Exception $e) {
            // Gérer l'exception ici
            return response()->json(['error' => 'Une erreur est survenue lors de la mise à jour du bon de versement.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
