<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\bonapprovisionnemnt as BonApprovisionnement;

class ApiController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createBonVersement(Request $request)
    {

        $controller = new BonVersementController;

        return $controller->store($request);

    }

    public function updateBonVersement(Request $request, $id)
    {
        $controller = new BonVersementController;

        return $controller->update($request,$id);
    }

    // Bon de caisse

    public function createFacture(Request $request)
    {

        $controller = new BonCaisseController;

        return $controller->createFacture($request);

    }

    public function saveFacture(Request $request)
    {

        $controller = new BonCaisseController;

        return $controller->storeFacture($request);

    }

    public function createAvance(Request $request)
    {

        $controller = new BonCaisseController;

        return $controller->createAvance($request);

    }

    public function createAutre(Request $request)
    {

        $controller = new BonCaisseController;

        return $controller->createAutres($request);

    }

    public function getBonCaisse($date_emission,$beneficiaire_id)
    {

        $controller = new BonCaisseController;

        return $controller->show($date_emission,$beneficiaire_id);

    }

    public function updateBonCaisse($id,$beneficiaire_id, Request $request)
    {

        $controller = new BonCaisseController;

        return $controller->update($request,$id,$beneficiaire_id);

    }

    // Bon appro

    public function createBonAp(Request $request)
    {
        $controller = new bondapprovisonnement;

        return $controller->store($request);
    }

    public function updateBonAp(Request $request, $id)
    {

        $bon = BonApprovisionnement::find($id);

        $controller = new bondapprovisonnement;

        return $controller->update($request,$bon);

    }

    public function deleteBonAp(Request $request, $id)
    {

        $bon = BonApprovisionnement::find($id);

        $controller = new bondapprovisonnement;

        return $controller->destroy($bon);

    }

}
