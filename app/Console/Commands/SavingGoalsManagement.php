<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SavingsGoal;
use Illuminate\Support\Facades\DB;

class SavingGoalsManagement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:saving-goals-management';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manages automatic salary deposits and updates savings goals progress';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->day;
      
        $users = User::whereNotNull('salaire_mensuel')
                    ->whereNotNull('date_credit')
                    ->get();

        foreach ($users as $user) {
            // if ($today == $user->date_credit) {
            //     $this->info("✅ C'est le jour de crédit pour {$user->name}");
                
            //     DB::beginTransaction();
            
            //         $savingsGoals = SavingsGoal::where('user_id', $user->id)
            //             ->where('date_objectif', '>', now())
            //             ->get();

            //         foreach ($savingsGoals as $goal) {
                     
            //             $amountToSave = ($user->salaire_mensuel * $goal->Pourcentage) / 100;
            //             $this->info("💸 Montant à épargner ce mois: {$amountToSave} DH");
                        
            //             $goal->montant_epargne = ($goal->montant_epargne ?? 0) + $amountToSave;
            //             $goal->progression = ($goal->montant_epargne / $goal->montant) * 100;
                        
            //             $goal->save();

            //             $user->Budjet -= $amountToSave;
            //             $user->save();

            //             $this->info("✨ Nouveau montant épargné total: {$goal->montant_epargne} DH");
            //             $this->info("📈 Progression: {$goal->progression}%");
            //         }
                    
            //         DB::commit();
            //         $this->info("\n✅ Transactions validées pour {$user->name}");
              
            // } else {
            //     $this->info("⏳ Ce n'est pas encore le jour de crédit pour {$user->name}");
            // }
   
            $savingsGoals = SavingsGoal::where('user_id', $user->id)->get();
            
            foreach ($savingsGoals as $savingsGoal) {
                if($savingsGoal->montant_epargne < $savingsGoal->montant){
                    $savingsGoal->montant_epargne = $savingsGoal->montant_epargne + ($savingsGoal->montant * $savingsGoal->Pourcentage) / 100;
                    $savingsGoal->progression += $savingsGoal->Pourcentage;
                    $savingsGoal->save();
                    $this->info("\n✅ Objectif Progression done");
                }
            }
        }

        $this->info("\n✅ Traitement terminé.");
    }
}
