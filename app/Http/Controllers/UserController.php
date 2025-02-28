<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Depense;
use App\Models\DepenseRecurrente;

class UserController extends Controller
{
    
    public function UserDashboard()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $categories= DB::table('categories')->distinct()->get();
        $totalDepenses=Depense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('prix');
        $totalDepensesRecurrente=DepenseRecurrente::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)
        ->sum('montant');
        $categoryCount= DB::table('categories')->count();
        $TotalAllDepenses=$totalDepenses+$totalDepensesRecurrente;
        return view('User.dashboard',[
            "categories"=>$categories,
            "TotalAllDepenses"=>$TotalAllDepenses
        ]);
     
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
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;


        $categories= DB::table('categories')->distinct()->get();
        $Depenses = Depense::with('categorie')->where('user_id', auth()->id()) ->get();
        $DepensesRecurrente = DepenseRecurrente::with('categorie')->where('user_id', auth()->id()) ->get();
        $totalDepenses=Depense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)->where('user_id', auth()->id())
        ->sum('prix');
        $totalDepensesRecurrente=DepenseRecurrente::whereMonth('created_at', $currentMonth)->where('user_id', auth()->id())->whereYear('created_at', $currentYear)
        ->sum('montant');
        $categoryCount= DB::table('categories')->count();

       // dd($totalDepenses);
        return view('User.expenses.index',[
        "categories"=> $categories,
        "Depenses"=> $Depenses,
        "DepensesRecurrente"=> $DepensesRecurrente,
        "totalDepenses"=>$totalDepenses,
        "totalDepensesRecurrente"=>$totalDepensesRecurrente,
        "categoryCount"=>$categoryCount
    ]);

    }
          

   public function StoreSideHustle(Request $request ){

    $request->validate([
        'side_hustle_amount' => 'required|numeric|min:0',
    ]);

    $user = User::findOrFail(Auth::user()->id);
    $user->Budjet+=$request->input('side_hustle_amount');
    
    $user->save();

    return back();

   } 
} 