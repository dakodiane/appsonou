<?php

namespace App\Http\Controllers;

use App\Models\BonCaisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BonCaisseController extends Controller
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
    public function createFacture(Request $request)
    {
        // Valider les données d'entrée pour la création de factures
        $request->validate([
            'montant_facture' => 'required|numeric',
            'date_emission' => 'required|date',
            'nature_retenue' => 'required|in:prestation,achat',
        ]);

        // Créez et sauvegardez le bon de caisse de type "facture"
        $bon = new BonCaisse;
        $bon->type = 'facture';
        $bon->montant_facture = $request->montant_facture;
        $bon->date_emission = $request->date_emission;
        $bon->nature_retenue = $request->nature_retenue;
        $bon->user_id = 1;


        $bon->save();
        return response()->json(['message' => 'Facture enregistrée avec succès']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFacture(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:bon_caisses',
            'categorie_id' => 'required|exists:categories,id',
            'beneficiaire_id' => 'required|exists:beneficiaires,id',
            'motif_operation' => 'required',
            'montant_facture' => 'required|numeric',
            'montant_imposable' => 'required|numeric',
            'montant_aib' => 'required|numeric',
            'taux_ab' => 'required|in:0.01,0.03,0.05',
            'avance_perçue' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Recherchez la facture existante
        $facture = BonCaisse::where('id', $request->id)->first();

        if (!$facture) {
            return response()->json(['message' => 'Facture non trouvée.'], 404);
        }
        // Calculer le montant AIB
        $montantAIB = $request->montant_imposable * $request->taux_ab;

        // Calculer le montant net à payer
        $montantNetAPayer = $request->montant_facture - $montantAIB;

        // Vérifier si le montant net à payer est inférieur à 100 000
        if ($montantNetAPayer > 100000) {
            return response()->json(['message' => 'Le montant net à payer dépasse 100 000.'], 400);
        }

        // Ajoutez les détails du paiement à la facture
        $facture->beneficiaire_id = $request->beneficiaire_id;
        $facture->montant_facture = $request->montant_facture;
        $facture->motif_operation = $request->motif_operation;
        $facture->date_emission = $request->date_emission;
        $facture->avance_perçue = $request->avance_perçue;
        $facture->montant_imposable = $request->montant_imposable;
        $facture->taux_ab = $request->taux_ab;
        $facture->montant_aib = $montantAIB;
        $facture->montant_paye = $montantNetAPayer;

        $facture->save();

        return response()->json(['message' => 'Paiement de facture enregistré avec succès']);
    }


    public function createAvance(Request $request)
    {
        //
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'beneficiaire_id' => 'required|exists:beneficiaires,id',
            'montant_facture' => 'required|numeric',
            'avance_perçue' => 'required|numeric',
            'date_emission' => 'required|date',
            'motif_operation' => 'required',
        ]);

        // Créez et sauvegardez le bon de caisse de type "facture"
        $avance = new BonCaisse;
        $avance->type = 'avance';
        $avance->beneficiaire_id = $request->beneficiaire_id;
        $avance->montant_facture = $request->montant_facture;
        $avance->date_emission = $request->date_emission;
        $avance->avance_perçue = $request->avance_perçue;
        $avance->motif_operation = $request->motif_operation;
        $avance->user_id = 1;


        $avance->save();
        return response()->json(['message' => 'Paiement d/avance effectué avec succès']);
    }

    public function createAutres(Request $request)
    {
        //
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'beneficiaire_id' => 'required|exists:beneficiaires,id',
            'montant_facture' => 'required|numeric',
            'date_emission' => 'required|date',
            'motif_operation' => 'required',
        ]);

        // Créez et sauvegardez le bon de caisse de type "facture"
        $avance = new BonCaisse;
        $avance->type = 'autres';
        $avance->beneficiaire_id = $request->beneficiaire_id;
        $avance->montant_facture = $request->montant_facture;
        $avance->date_emission = $request->date_emission;
        $avance->motif_operation = $request->motif_operation;
        $avance->user_id = 1;


        $avance->save();
        return response()->json(['message' => 'Paiement effectué avec succès']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date_emission, $beneficiaire_id)
    {
        // Recherchez tous les bons de caisse correspondant à la date et au bénéficiaire
        $bons = BonCaisse::where('date_emission', $date_emission)
            ->where('beneficiaire_id', $beneficiaire_id)
            ->get();
        
        if ($bons->isEmpty()) {
            return response()->json(['message' => 'Aucun bon de caisse trouvé'], 404);
        }
        
        $bonsInfo = [];
        
        foreach ($bons as $bon) {
            $numeroBon = $bon->id;
            $motif = $bon->motif_operation;
            $dateEmission = $bon->date_emission;
            
            // Ajoutez les informations de chaque bon au tableau
            $bonsInfo[] = [
                'id' => $numeroBon,
                'motif_operation' => $motif,
                'date_emission' => $dateEmission
            ];
        }
        
        return response()->json($bonsInfo);
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
    public function update(Request $request, $id, $beneficiaire_id)
    {
        // Recherchez le bon de caisse en fonction de son ID et du bénéficiaire
        $bon = BonCaisse::where('id', $id)
            ->where('beneficiaire_id', $beneficiaire_id)
            ->first();
        
        if (!$bon) {
            return response()->json(['message' => 'Bon de caisse introuvable'], 404);
        }
        
        // Mettez à jour les attributs du bon de caisse en fonction de la demande
      
        $bon->date_emission = $request->date_emission;
        $bon->montant_facture = $request->montant_facture;
        // Assignez les autres attributs de la même manière...
    
        $bon->save();
    
        return response()->json(['message' => 'Bon de caisse mis à jour avec succès']);
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
