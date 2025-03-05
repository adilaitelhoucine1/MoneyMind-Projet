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
        $users = User::whereNotNull('salaire_mensuel')
                    ->whereNotNull('date_credit')
                    ->get();

        foreach ($users as $user) {
            $objectifs = SavingsGoal::where('user_id', $user->id)->get();
            
            foreach ($objectifs as $objectif) {
// ba9i mawslsh obkectif dyalo
                if ($objectif->montant_epargne < $objectif->montant) {
                    // montant bash ayb9a ytzad dakshi
                    $epargne = ($objectif->montant * $objectif->Pourcentage) / 100;
                    
                    if ($user->Budjet >= $epargne) {
// zid dakshi li khasi ytzad  ($epargne)
                        $objectif->montant_epargne += $epargne;
                        $objectif->progression += $objectif->Pourcentage;
                        $user->Budjet -= $epargne;
 // reste : chhal ba9i lk twsl objectif 
                        $reste = $objectif->montant - $objectif->montant_epargne;
                        if ($user->Budjet > 0 && $reste > 0) {
                            $epargneSupp = min($user->Budjet, $reste);
                            if ($epargneSupp > 0) {
                                $objectif->montant_epargne += $epargneSupp;
                                $objectif->Pourcentage += ($epargneSupp / $objectif->montant) * 100;
                                $objectif->progression = ($objectif->montant_epargne / $objectif->montant) * 100;
                                $user->Budjet -= $epargneSupp;

                                $this->info("💰 Extra épargné: {$epargneSupp} DH");
                                $this->info("📈 Nouveau %: {$objectif->Pourcentage}%");
                            }
                        }

                        $objectif->save();
                        $user->save();

                        $this->info("✅ Objectif mis à jour:");
                        $this->info("💸 Épargné: {$epargne} DH");
                        $this->info("📊 Total: {$objectif->montant_epargne} DH");
                        $this->info("📈 Progression: {$objectif->progression}%");
                        $this->info("💳 Reste: {$user->Budjet} DH");
                    } else {
                        $this->info("⚠️ Pas assez de budget pour {$user->name}");
                    }
                } else {
                    $this->info("🎯 Objectif atteint: {$user->name}");
                }
            }
        }
        $this->info("✅ Terminé");
    }
}

