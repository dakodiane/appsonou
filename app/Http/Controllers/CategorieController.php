<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    public function index()
    {
        $Categorie = Categorie::all();
        return view('Categorie.index', compact('Categorie'));
    }

    public function create()
    {
        return view('Categorie.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required',
            'slug' => 'required',
        ]);

        Categorie::create($validatedData);

        return redirect()->route('Categorie.index')
                         ->with('success', 'Catégorie ajouté avec succès.');
    }

    public function show(Categorie $categorie)
    {
        return view('Categorie.show', compact('categorie'));
    }

    public function edit(Categorie $categorie)
    {
        return view('Categorie.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $validatedData = $request->validate([
            'label' => 'required',
            'slug' => 'required' .$categorie->id,
        ]);

        $categorie->update($validatedData);

        return redirect()->route('Categorie.index')
                         ->with('success', 'catégorie mis à jour avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('Categorie.index')
                         ->with('success', 'catégorie supprimé avec succès.');
    }

}
