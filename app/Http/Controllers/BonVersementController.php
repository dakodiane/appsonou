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

    // public function storeFacture(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'id' => 'required|exists:bon_caisses',
    //             'categorie_id' => 'required|exists:categories,id',
    //             'beneficiaire_id' => 'required|exists:beneficiaires,id',
    //             'motif_operation' => 'required',
    //             'montant_facture' => 'required|numeric',
    //             'montant_imposable' => 'required|numeric',
    //             'montant_aib' => 'required|numeric',
    //             'taux_ab' => 'required|in:0.01,0.03,0.05',
    //             'avance_perçue' => 'required|numeric',
    //         ]);
    
    //         if ($validator->fails()) {
    //             return response()->json(['errors' => $validator->errors()], 400);
    //         }
    
    //         // Recherchez la facture existante
    //         $facture = BonCaisse::where('id', $request->id)->first();
    
    //         if (!$facture) {
    //             return response()->json(['message' => 'Facture non trouvée.'], 404);
    //         }
            
    //         // Calculer le montant AIB
    //         $montantAIB = $request->montant_imposable * $request->taux_ab;
    
    //         // Calculer le montant net à payer
    //         $montantNetAPayer = $request->montant_facture - $montantAIB;
    
    //         // Vérifier si le montant net à payer est inférieur à 100 000
    //         if ($montantNetAPayer > 100000) {
    //             return response()->json(['message' => 'Le montant net à payer dépasse 100 000.'], 400);
    //         }
    
    //         // Ajoutez les détails du paiement à la facture
    //         $facture->beneficiaire_id = $request->beneficiaire_id;
    //         $facture->montant_facture = $request->montant_facture;
    //         $facture->motif_operation = $request->motif_operation;
    //         $facture->date_emission = $request->date_emission;
    //         $facture->avance_perçue = $request->avance_perçue;
    //         $facture->montant_imposable = $request->montant_imposable;
    //         $facture->taux_ab = $request->taux_ab;
    //         $facture->montant_aib = $montantAIB;
    //         $facture->montant_paye = $montantNetAPayer;
    
    //         $facture->save();
    
    //         return response()->json(['message' => 'Paiement de facture enregistré avec succès']);
    //     } catch (\Exception $e) {
    //         // Gérer l'exception ici
    //         return response()->json(['error' => 'Une erreur est survenue lors de lenregistrement de la facture.'], 500);
    //     }
    // }
    

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
        //
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
