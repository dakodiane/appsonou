<?php

namespace App\Http\Controllers;

use App\Models\bonapprovisionnemnt as BonApproVisionnement;
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


            // On retourne les informations du bon  en JSON

            try {

                $this->validate($request, [
                    'code' => 'required',
                    'date_appro' => 'required|date',
                    'objet' => 'required',
                    'montant' => 'required|numeric',
                    'mode' => 'required',
                    'user_id' => 'required|exists:users,id',
                ]);

            // On crée un bon d'approvisionnement
                $bonApprovisionnement = BonApproVisionnement::create([
                    'code' => $request->name,
                    'date_appro' => $request->email,
                    'object' => $request->object,
                    'montant' => $request->montant,
                    'mode' => $request->mode,
                    'user_id' => $request->user_id,

                ]);

                // On retourne la réponse JSON
                return response()->json($bonApprovisionnement, 201);

            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()],200);
            }

        }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
    public function show(BonApproVisionnement $bonapprovisionnemnt)
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
    public function update(Request $request, BonApproVisionnement $bonapprovisionnemnt)
    {
        // La validation de donnée


        // On modifie les informations du bon

        try {

            $this->validate($request, [
                'code' => 'required',
                'date_appro' => 'required|date',
                'objet' => 'required',
                'montant' => 'required|numeric',
                'mode' => 'required',
                'user_id' => 'required|exists:users,id',
            ]);

            $bonapprovisionnemnt->update([
                'code' => $request->name,
                'date_appro' => $request->email,
                'object' => $request->object,
                'montant' => $request->montant,
                'mode' => $request->mode,
                'user_id' => $request->user_id,
            ]);

            // On retourne la réponse JSON
            return response()->json([],200);

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonApproVisionnement $bonapprovisionnemnt)
    {
              // On supprime le bon

            try {

                $bonapprovisionnemnt->delete();

              // On retourne la réponse JSON
              return response()->json([],200);

            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()],200);
            }

    }

}

