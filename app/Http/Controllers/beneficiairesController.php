<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class beneficiairesController extends Controller
{




    public function index()
    {
        $beneficiaires = Beneficiaire::all();
        return view('beneficiaires.index', compact('beneficiaires'));
    }

    public function create()
    {
        return view('beneficiaires.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_complet' => 'required',
            'tel' => 'required',
            'ifu' => 'required',
            'adresse' => 'required',
            'poste' => 'required',
        ]);

        Beneficiaire::create($validatedData);

        return redirect()->route('beneficiaires.index')
                         ->with('success', 'Bénéficiaire ajouté avec succès.');
    }

    public function show(Beneficiaire $beneficiaire)
    {
        return view('beneficiaires.show', compact('beneficiaire'));
    }

    public function edit(Beneficiaire $beneficiaire)
    {
        return view('beneficiaires.edit', compact('beneficiaire'));
    }

    public function update(Request $request, Beneficiaire $beneficiaire)
    {
        $validatedData = $request->validate([
            'nom_complet' => 'required',
            'tel' => 'required',
            'ifu' => 'required',
            'adresse' => 'required',
            'poste' => 'required',
        ]);

        $beneficiaire->update($validatedData);

        return redirect()->route('beneficiaires.index')
                         ->with('success', 'Bénéficiaire mis à jour avec succès.');
    }

    public function destroy(Beneficiaire $beneficiaire)
    {
        $beneficiaire->delete();

        return redirect()->route('beneficiaires.index')
                         ->with('success', 'Bénéficiaire supprimé avec succès.');
    }
}


