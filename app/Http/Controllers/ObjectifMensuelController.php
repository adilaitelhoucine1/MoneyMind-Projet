<?php

namespace App\Http\Controllers;

use App\Models\ObjectifMensuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjectifMensuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objectifs = ObjectifMensuel::where('user_id', Auth::id())->get();
        return view('objectifs.index', compact('objectifs'));
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
        try {
            
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'montant' => 'required|numeric|min:0',
                'date_objectif' => 'required|date|after:today'
            ]);
          

            if (!auth()->check()) {
                throw new \Exception('User not authenticated');
            }

            $objectif = ObjectifMensuel::create([
                'user_id' => auth()->id(),
                'nom' => $request->nom,
                'montant' => $request->montant,
                'date_objectif' => $request->date_objectif
            ]);


            return redirect()->back()->with('success', 'Objectif d\'épargne créé avec succès');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'objectif: ' . $e->getMessage())->withInput();
        }
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
        $objectif = ObjectifMensuel::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date_objectif' => 'required|date|after:today'
        ]);

        $objectif->update([
            'nom' => $request->nom,
            'montant' => $request->montant,
            'date_objectif' => $request->date_objectif
        ]);

        return back()->with('success', 'Objectif d\'épargne mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $objectif = ObjectifMensuel::where('user_id', Auth::id())->findOrFail($id);
        $objectif->delete();

        return back()->with('success', 'Objectif d\'épargne supprimé avec succès');
    }
}
