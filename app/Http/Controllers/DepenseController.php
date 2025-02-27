<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Depense;


class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= DB::table('categories')->distinct()->get();
        $Depenses = Depense::with('categorie')
        ->where('user_id', auth()->id()) 
        ->get();
 
       
        return view('User.expenses.index',[
            "categories"=> $categories,
            "Depenses"=> $Depenses
    
    ]);
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
            'prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        Depense::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('depenses.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
        ]);
    
        $depense = Depense::findOrFail($id);
        $depense->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
        ]);
    
        return redirect()->route('depenses.index');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->delete();
    
        return redirect()->back();
    }
    
}
