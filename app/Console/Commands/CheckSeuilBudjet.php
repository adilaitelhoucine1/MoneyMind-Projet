<?php

namespace App\Console\Commands;
use App\Models\User;
use App\Models\Alerte;
use App\Models\Depense;
use Illuminate\Support\Facades\Mail;
use App\Mail\BudgetAlertMail;

use Illuminate\Console\Command;

class CheckSeuilBudjet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-seuil-budjet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user){
            $totalDepenses = Depense::where('user_id', $user->id)->sum('prix');
            if($user->seuil_alerte_global == 0 || $user->salaire_mensuel <= 0) {
                $this->warn("L'utilisateur {$user->name} n'a pas défini de seuil d'alerte ou de salaire valide.");
                continue;
            }         $pourcentageDepense = ($totalDepenses / $user->salaire_mensuel) * 100;
             if($pourcentageDepense > $user->seuil_alerte_global){
                Alerte::create([
                    'user_id' => $user->id,
                    'message' => " Attention : Vos dépenses ({$pourcentageDepense}%) ont dépassé votre seuil d'alerte ({$user->seuil_alerte_global}%) du budget mensuel",
                    'type' => 'budget_bas',
                    'est_lu' => false
                ]);

               // Mail::to($user->email)->send(new BudgetAlertMail($user, $pourcentageDepense));
                
                $this->info("Alerte et email envoyés à {$user->name}");
             }

        }
    }
}
