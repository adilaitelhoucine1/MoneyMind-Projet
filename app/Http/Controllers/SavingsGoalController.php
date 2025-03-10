<?php

namespace App\Http\Controllers;

use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingsGoalController extends Controller
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
        // dd($request);
          
                //dd("TRY block executed");

                // $validated = $request->validate([
                //     'nom' => 'required|string|max:255',
                //     'montant' => 'required|numeric|min:0',
                //     'date_objectif' => 'required|date|after:today',
                //     'Pourcentage' => 'required|numeric|min:1|max:100'
                // ]);
             //$count=SavingsGoal::where('user_id',Auth()->id())->count();
           
                SavingsGoal::create([
                    'user_id' => auth()->id(),
                    'nom' => $request->input('nom'),
                    'montant' => $request->input('montant'),
                    'date_objectif' =>$request->input('date_objectif'),
                    'Pourcentage' => $request->input('Pourcentage'),
                    'montant_epargne' => 0,
                    'progression' => 0
                ]);

                return redirect()->back();
      
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
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date_objectif' => 'required|date|after:today',
            'Pourcentage' => 'required|numeric|min:1|max:100'
        ]);

        try {
            $goal = SavingsGoal::findOrFail($id);
            
            if ($goal->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Non autorisé à modifier cet objectif.');
            }

            $goal->update([
                'nom' => $validated['nom'],
                'montant_objectif' => $validated['montant'],
                'date_objectif' => $validated['date_objectif'],
                'Pourcentage' => $validated['Pourcentage']
            ]);

            return redirect()->back()->with('success', 'Objectif d\'épargne mis à jour avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'objectif.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    
    //         $goal = SavingsGoal::findOrFail($id);

    //         $goal->delete();
    //         return redirect()->back();
    
    // }

    public function destroy($id)
    {
        try {
            $goal = SavingsGoal::findOrFail($id);
            
            // Check if the goal belongs to the authenticated user
            if ($goal->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Non autorisé à supprimer cet objectif.');
            }

            $goal->delete();
            return redirect()->back()->with('success', 'Objectif d\'épargne supprimé avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'objectif.');
        }
    }
}
