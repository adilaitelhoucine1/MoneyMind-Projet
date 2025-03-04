<?php

namespace App\Http\Controllers;
use App\Models\ListeSouhaits;
use App\Models\Categorie;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishes = ListeSouhaits::with('categorie')->where('user_id', auth()->id())->get();
        $categories=Categorie::all();
       // dd($wishes);
        return view('User.wishlist', [

            'wishes'=>$wishes,
            'categories'=>$categories,

        ]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        try {
           // dd("block try ");
           
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'category' => 'required|exists:categories,id',
                'priorite' => 'required|in:faible,moyenne,élevée'
            ]);
//dd("validation");
            ListeSouhaits::create([
                'nom' => $request->name,
                'prix_estime' => $request->price,
                'categorie_id' => $request->category,
                'user_id' => auth()->id(),
                'priorite' => $request->priorite
            ]);

            return redirect()->route('wishlist.index')
                ->with('success', 'Souhait ajouté avec succès!');
        } catch (\Exception $e) {
                 return redirect()->route('wishlist.index')
                ->with('error', 'Une erreur est survenue lors de l\'ajout du souhait.');
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
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'current_amount' => 'required|numeric|min:0',
                'category' => 'required|exists:categories,id',
                'priorite' => 'required|in:faible,moyenne,élevée'
            ]);

            $wish = ListeSouhaits::findOrFail($id);

            $wish->update([
                'nom' => $request->name,
                'prix_estime' => $request->price,
                'montant_actuel' => $request->current_amount,
                'categorie_id' => $request->category,
                'priorite' => $request->priorite
            ]);

            return redirect()->route('wishlist.index')
                ->with('success', 'Souhait modifié avec succès!');
        } catch (\Exception $e) {
            \Log::error('Error updating wish: ' . $e->getMessage());
            return redirect()->route('wishlist.index')
                ->with('error', 'Une erreur est survenue lors de la modification du souhait.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
            $wish = ListeSouhaits::findOrFail($id);
     

            $wish->delete();

            return redirect()->route('wishlist.index');
    }
} 