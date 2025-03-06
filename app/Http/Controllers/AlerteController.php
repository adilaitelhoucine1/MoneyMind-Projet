<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alerte;  
class AlerteController extends Controller
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
        //
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
    public function update(Request $request)
    {
        $request->validate([
            'Seuil_global' => 'required|numeric|min:1|max:100'
        ]);

        auth()->user()->update([
            'seuil_alerte_global' => $request->Seuil_global
        ]);

        

        return redirect()->back();
    }

   
        public function MarkAsdone($id)
        {
            $alerte = Alerte::find($id);
            $alerte->est_lu = true;
            $alerte->save();

            return redirect()->back();
        }
}
