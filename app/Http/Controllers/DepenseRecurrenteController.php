<?php

namespace App\Http\Controllers;
use App\Models\DepenseRecurrente;

use Illuminate\Http\Request;

class DepenseRecurrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'date_extraction_salaire' => 'required|date',
        ]);

        DepenseRecurrente::create([
            'nom' => $request->nom,
            'montant' => $request->montant,
            'categorie_id' => $request->categorie_id,
            'user_id' => auth()->user()->id,
            'date_extraction_salaire' => $request->date_extraction_salaire
        ]);
        
        return redirect()->route('user.expense');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'date_extraction_salaire' => 'required|date'
        ]);
        $DepenseRecurrente = DepenseRecurrente::findOrFail($id);
        $DepenseRecurrente->update([
            'nom' => $request->nom,
            'montant' => $request->montant,
            'categorie_id' => $request->categorie_id,
            'date_extraction_salaire' => $request->date_extraction_salaire
        ]);

        return redirect()->route('user.expense');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $DepenseRecurrente = DepenseRecurrente::findOrFail($id);
        $DepenseRecurrente->delete();
    
        return redirect()->back();
    }
}
