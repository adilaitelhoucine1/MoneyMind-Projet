<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Depense;
use App\Models\DepenseRecurrente;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $TotalUsers= User::where('role','user')->count();;
        $totalDepenses=Depense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('prix');
        $totalDepensesRecurrente=DepenseRecurrente::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)
        ->sum('montant');
        $TotalDepenses=$totalDepenses+$totalDepensesRecurrente;
        $RevenuMensuelMoyen = round(User::avg('salaire_mensuel'), 2);

        return view('admin.dashboard',
            [
                "TotalUsers"=>$TotalUsers ,             
                "TotalDepenses"=>$TotalDepenses,             
                "RevenuMensuelMoyen"=>$RevenuMensuelMoyen,          
            ]
    );
    }
    public function users()
{
    $users = User::where('role', '<>', 'admin')->get();
  


    return view('admin.users.index',
    ["users"=>$users]
);
}

}
