<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserDashboard()
    {
        return view('User.dashboard');  
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
} 