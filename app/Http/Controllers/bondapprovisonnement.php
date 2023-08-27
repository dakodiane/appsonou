<?php

namespace App\Http\Controllers;

use App\Models\bonapprovisionnemnt;
use Illuminate\Http\Request;

class bondapprovisonnement extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            // La validation de données
            $this->validate($request, [
                'code' => 'required',
                'date_appro' => 'required|date',
                'objet' => 'required',
                'montant' => 'required|numeric',
                'mode' => 'required',
                'user_id' => 'required|exists:users,id',
        ]);

        // On crée un bon d'approvisionnement
        $bonApprovisionnement = bondapprovisonnement::create([
            'code' => $request->name,
            'date_appro' => $request->email,
            'object' => $request->object,
            'montant' => $request->montant,
            'mode' => $request->mode,
            'user_id' => $request->user_id,

        ]);

        // On retourne les informations du bon  en JSON
        return response()->json($bonApprovisionnement, 201);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
    public function show(bonapprovisionnemnt $bonapprovisionnemnt)
    {
        return response()->json($bonapprovisionnemnt);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bonapprovisionnemnt $bonapprovisionnemnt)
    {
        // La validation de donnée
        $this->validate($request, [
            'code' => 'required',
            'date_appro' => 'required|date',
            'objet' => 'required',
            'montant' => 'required|numeric',
            'mode' => 'required',
            'user_id' => 'required|exists:users,id',
    ]);

    // On modifie les informations du bon
    $bonapprovisionnemnt->update([
            'code' => $request->name,
            'date_appro' => $request->email,
            'object' => $request->object,
            'montant' => $request->montant,
            'mode' => $request->mode,
            'user_id' => $request->user_id,
    ]);

    // On retourne la réponse JSON
    return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
    public function destroy(bonapprovisionnemnt $bonapprovisionnemnt)
    {
              // On supprime le bon
              $bonapprovisionnemnt->delete();

              // On retourne la réponse JSON
              return response()->json();
    }
    
}             

