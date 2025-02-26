<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= DB::table('categories')->distinct()->get();

        return view('admin.categories.index',["categories"=>$categories]);
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
            'nom' => 'required|string|max:255'
        ]);

         $category = Categorie::create([
               'nom' => $request->input('nom'),
        ]);

           

            return redirect()->route('admin.categories');
 
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
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

           $category = Categorie::findOrFail($id);
            $category->update([
                'nom' => $request->input('nom')
            ]);

            return redirect()->route('admin.categories')
                ->with('success', 'Catégorie modifiée avec succès');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = DB::table('categories')->where('id', '=', $id)->delete();

            return redirect()->route('admin.categories');

    }
}
