<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Depense;
use App\Models\Categorie;
use App\Models\DepenseRecurrente;
use App\Models\SavingsGoal;
use App\Models\Alerte;
use App\Services\GeminiService;
class UserController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function UserDashboard()
    {
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $depenses=Depense::all();
        
        $depensesRecurrentes=DepenseRecurrente::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)->get();
        
        
        $categories= DB::table('categories')->distinct()->get();
        $totalDepenses=Depense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('prix');
        $totalDepensesRecurrente=DepenseRecurrente::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)
        ->sum('montant');
        $categoryCount= DB::table('categories')->count();
        $TotalAllDepenses=$totalDepenses+$totalDepensesRecurrente;
        $budget = User::where('id', Auth::user()->id)->value('Budjet');
        if($budget !=0){

            $BudjetRestant=$budget-$TotalAllDepenses;
    
            $pourcentageRestant=($TotalAllDepenses*100)/$budget;
        }else{
            $BudjetRestant=0;
            $pourcentageRestant=0;
        }
        
        $suggestions = $this->geminiService->getSuggestions($depenses, $depensesRecurrentes, $budget);

        $repartitionDepense = DB::table('depenses')
            ->select('categories.nom', DB::raw('SUM(depenses.prix) as total'))
            ->join('categories', 'depenses.categorie_id', '=', 'categories.id')
            ->where('depenses.user_id', Auth::id())
            ->whereMonth('depenses.created_at', $currentMonth)
            ->whereYear('depenses.created_at', $currentYear)
            ->groupBy('categories.nom')
            ->get();

        $repartitionRecurrente = DB::table('depenses_recurrentes')
            ->select('categories.nom', DB::raw('SUM(depenses_recurrentes.montant) as total'))
            ->join('categories', 'depenses_recurrentes.categorie_id', '=', 'categories.id')
            ->where('depenses_recurrentes.user_id', Auth::id())
            ->whereMonth('depenses_recurrentes.created_at', $currentMonth)
            ->whereYear('depenses_recurrentes.created_at', $currentYear)
            ->groupBy('categories.nom')
            ->get();

        
        $repartitionDepense = $repartitionDepense->concat($repartitionRecurrente)
            ->groupBy('nom');

        $repartitionFinale = [];
        foreach ($repartitionDepense as $nom => $items) {
            $repartitionFinale[$nom] = $items->sum('total');
        }

        $categories = Categorie::select('nom')->get();

        // Récupérer les objectifs d'épargne
        $objectifs = SavingsGoal::where('user_id', Auth::id())
            ->orderBy('date_objectif', 'asc')
            ->get()
            ->map(function($objectif) {
                $montantActuel = $objectif->montant * 0; 
                $pourcentage = ($montantActuel / $objectif->montant) * 100;
                return [
                    'id' => $objectif->id,
                    'nom' => $objectif->nom,
                    'montant_objectif' => $objectif->montant,
                    'montant_actuel' => $montantActuel,
                    'pourcentage' => round($pourcentage, 2),
                    'progression' => $objectif->progression,
                    'montant_epargne' => $objectif->montant_epargne,
                    'date_objectif' => $objectif->date_objectif
                ];
            });

        //dd($repartition);

        $alertes = Alerte::where('user_id', Auth::id())
            ->where('est_lu', false)
            ->orderBy('created_at', 'desc')
            ->get();
//dd($alertes);
        return view('User.dashboard',[
            "categories"=>$categories,
            "TotalAllDepenses"=>$TotalAllDepenses,
            "budjet"=>$budget,
            "BudjetRestant"=>$BudjetRestant,
            "repartitionDepense"=>$repartitionFinale,
            "categories"=>$categories,
            "objectifs"=>$objectifs,
            "pourcentageRestant"=>$pourcentageRestant,
            "alertes" => $alertes,
            "suggestions" => $suggestions,
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