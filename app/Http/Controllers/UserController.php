<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function UserDashboard()
    {
        $categories= DB::table('categories')->distinct()->get();

        return view('User.dashboard',["categories"=>$categories]);
     
    }


    public function destroy(User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'Vous n\'avez pas la permission de supprimer des utilisateurs.');
        }

        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        try {
            $user->delete();
            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'utilisateur.');
        }
    }
    public function AddMensuelalaire(Request $request, $user_id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date_credit' => 'required|date' 
        ]);

        $user = User::findOrFail($user_id);
        $user->salaire_mensuel = $request->input('amount');
        $user->date_credit = $request->input('date_credit'); 
        $user->save();
    
        return back()->with('success', 'Salaire enregistré avec succès.');
    }
    public function Showexpense(){
        $categories= DB::table('categories')->distinct()->get();
        return view('User.expenses.index',["categories"=> $categories]);

    }
    
} 