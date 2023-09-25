<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\bonapprovisionnemnt as BonApproVisionnement;
=======
use App\Models\bonapprovisionnemnt;
>>>>>>> rebase-copy
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
<<<<<<< HEAD

=======
 
>>>>>>> rebase-copy
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    public function store(Request $request)
    {
            // La validation de données
<<<<<<< HEAD


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

=======
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
    
>>>>>>> rebase-copy

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function show(BonApproVisionnement $bonapprovisionnemnt)
=======
    public function show(bonapprovisionnemnt $bonapprovisionnemnt)
>>>>>>> rebase-copy
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
<<<<<<< HEAD
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
=======
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
>>>>>>> rebase-copy
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bonapprovisionnemnt  $bonapprovisionnemnt
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
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
=======
    public function destroy(bonapprovisionnemnt $bonapprovisionnemnt)
    {
              // On supprime le bon
              $bonapprovisionnemnt->delete();

              // On retourne la réponse JSON
              return response()->json();
    }
    
}             
>>>>>>> rebase-copy

