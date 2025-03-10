<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Depense;
use App\Models\DepenseRecurrente;
use App\Models\Categorie;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth();

        $TotalUsers = User::where('role', 'user')->count();
        $totalDepenses = Depense::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('prix');
        $totalDepensesRecurrente = DepenseRecurrente::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('montant');
        $TotalDepenses = $totalDepenses + $totalDepensesRecurrente;
        $RevenuMensuelMoyen = round(User::avg('salaire_mensuel'), 2);

        $TotalEpargne = User::sum('salaire_mensuel') - $TotalDepenses;
        
        $MoyenneDepenses = $TotalUsers > 0 ? round($TotalDepenses / $TotalUsers, 2) : 0;

        $EvolutionUtilisateurs = $this->calculerEvolution('users');
        $EvolutionRevenu = $this->calculerEvolution('revenu');
        $EvolutionDepenses = $this->calculerEvolution('depenses');
        $EvolutionEpargne = $this->calculerEvolution('epargne');

        // Top catégories
        $topCategories = Depense::select('categorie_id', DB::raw('SUM(prix) as total'))
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('categorie_id')
            ->orderByDesc('total')
            ->limit(3)
            ->get()
            ->map(function ($item) use ($TotalDepenses) {
                $categorie = Categorie::find($item->categorie_id);
                return (object)[
                    'nom' => $categorie ? $categorie->nom : 'Non catégorisé',
                    'total' => $item->total,
                    'pourcentage' => $TotalDepenses > 0 ? round(($item->total / $TotalDepenses) * 100, 1) : 0
                ];
            });

        // Données pour le graphique des dépenses
        $graphiqueDepenses = $this->getGraphiqueDepenses();

        // Distribution des utilisateurs
        $distributionUtilisateurs = $this->getDistributionUtilisateurs();

        // Dernières activités
        $dernieresActivites = collect([
            (object)[
                'type' => 'primary',
                'icone' => 'user-plus',
                'titre' => 'Nouveaux Utilisateurs',
                'description' => "Nombre d'inscriptions ce mois: " . $TotalUsers,
                'created_at' => Carbon::now()
            ],
            (object)[
                'type' => 'success',
                'icone' => 'chart-line',
                'titre' => 'Dépenses Totales',
                'description' => "Total des dépenses: " . number_format($TotalDepenses, 2) . " DH",
                'created_at' => Carbon::now()
            ],
            (object)[
                'type' => 'warning',
                'icone' => 'piggy-bank',
                'titre' => 'Épargne',
                'description' => "Épargne totale: " . number_format($TotalEpargne, 2) . " DH",
                'created_at' => Carbon::now()
            ]
        ]);

        return view('admin.dashboard', compact(
            'TotalUsers',
            'TotalDepenses',
            'RevenuMensuelMoyen',
            'TotalEpargne',
            'MoyenneDepenses',
            'EvolutionUtilisateurs',
            'EvolutionRevenu',
            'EvolutionDepenses',
            'EvolutionEpargne',
            'dernieresActivites',
            'topCategories',
            'graphiqueDepenses',
            'distributionUtilisateurs'
        ));
    }

    public function users()
    {
        $users = User::where('role', '<>', 'admin')->get();
        return view('admin.users.index', ["users" => $users]);
    }

    private function calculerEvolution($type)
    {
        $currentMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        switch ($type) {
            case 'users':
                $current = User::whereMonth('created_at', $currentMonth->month)->count();
                $previous = User::whereMonth('created_at', $lastMonth->month)->count();
                break;
            case 'revenu':
                $current = User::whereMonth('created_at', $currentMonth->month)->avg('salaire_mensuel');
                $previous = User::whereMonth('created_at', $lastMonth->month)->avg('salaire_mensuel');
                break;
            case 'depenses':
                $current = Depense::whereMonth('created_at', $currentMonth->month)->sum('prix') +
                          DepenseRecurrente::whereMonth('created_at', $currentMonth->month)->sum('montant');
                $previous = Depense::whereMonth('created_at', $lastMonth->month)->sum('prix') +
                           DepenseRecurrente::whereMonth('created_at', $lastMonth->month)->sum('montant');
                break;
            case 'epargne':
                $currentRevenu = User::whereMonth('created_at', $currentMonth->month)->sum('salaire_mensuel');
                $currentDepenses = Depense::whereMonth('created_at', $currentMonth->month)->sum('prix') +
                                 DepenseRecurrente::whereMonth('created_at', $currentMonth->month)->sum('montant');
                $previousRevenu = User::whereMonth('created_at', $lastMonth->month)->sum('salaire_mensuel');
                $previousDepenses = Depense::whereMonth('created_at', $lastMonth->month)->sum('prix') +
                                  DepenseRecurrente::whereMonth('created_at', $lastMonth->month)->sum('montant');
                $current = $currentRevenu - $currentDepenses;
                $previous = $previousRevenu - $previousDepenses;
                break;
            default:
                return 0;
        }

        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function getGraphiqueDepenses()
    {
        $dates = collect();
        $data = collect();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates->push($date->format('D'));
            
            $totalJour = Depense::whereDate('created_at', $date->format('Y-m-d'))->sum('prix') +
                        DepenseRecurrente::whereDate('created_at', $date->format('Y-m-d'))->sum('montant');
            
            $data->push($totalJour);
        }

        return (object)[
            'labels' => $dates->toArray(),
            'data' => $data->toArray()
        ];
    }

    private function getDistributionUtilisateurs()
    {
        $actifs = User::where('role', 'user')
            ->whereDate('last_logged_in', '>=', Carbon::now()->subDays(7))
            ->count();
        
        $occasionnels = User::where('role', 'user')
            ->whereDate('last_logged_in', '>=', Carbon::now()->subDays(30))
            ->whereDate('last_logged_in', '<', Carbon::now()->subDays(7))
            ->count();
        
        $inactifs = User::where('role', 'user')
            ->whereDate('last_logged_in', '<', Carbon::now()->subDays(30))
            ->orWhereNull('last_logged_in')
            ->count();

        return (object)[
            'labels' => ['Actifs', 'Occasionnels', 'Inactifs'],
            'data' => [$actifs, $occasionnels, $inactifs]
        ];
    }
}
