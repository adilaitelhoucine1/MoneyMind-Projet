<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ListeSouhaits;
use App\Models\SavingsGoal;
use App\Models\User;
use Carbon\Carbon;

class WishlistManagament extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:wishlist-managament';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update wishlist items based on savings goals';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting wishlist management check...');

    
            $users = User::whereNotNull('salaire_mensuel')
                ->whereNotNull('date_credit')
                ->get();

            foreach ($users as $user) {
                $this->info("Processing user: {$user->name}");

                $savingsGoal = SavingsGoal::where('user_id', $user->id)
                    ->where('date_objectif', '>=', Carbon::now())
                    ->first();

                if (!$savingsGoal) {
                    $this->warn("ma3ndoush goals: {$user->name}");
                    continue;
                }

                $wishlists = ListeSouhaits::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->get();

                foreach ($wishlists as $wish) {
                    if ($savingsGoal->montant_epargne >= $wish->prix_estime) {
                        $wish->update([
                            'status' => 'completed',
                            'date_realisation' => Carbon::now(),
                            'montant_realise' => $wish->prix_estime,
                            'progression' => 100.00
                        ]);

                        
                        $newAmount = $savingsGoal->montant_epargne - $wish->prix_estime;
                        $savingsGoal->update([
                            'montant_epargne' => $newAmount,
                            'progression' => round(($newAmount / $savingsGoal->montant) * 100, 2),
                            
                        ]);

                        $this->info("Wishlist item '{$wish->nom}' completed for user: {$user->name}");
                    } else {
                    
                        $wish->update([
                            'status' => 'pending',
                            'montant_realise' => $savingsGoal->montant_epargne,
                            'progression' => round(($savingsGoal->montant_epargne / $wish->prix_estime) * 100, 2)
                        ]);

                        $savingsGoal->update([
                            'montant_epargne' => 0,
                            'progression' => 0
                        ]);

                        $this->info("Wishlist item '{$wish->nom}' partially funded for user: {$user->name}");
                    }
                }
            }

            $this->info('Wishlist management completed successfully!');
   

        return 0;
    }
}
