<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Auth; 

use Carbon\Carbon;
use App\Models\User;

use Illuminate\Console\Command;

class AddSalary extends Command
{
    protected $signature = 'salary:add';
    protected $description = 'Ajoute le salaire mensuel aux utilisateurs le jour défini (par exemple, le 10 de chaque mois)';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        
        if ($today->day == Carbon::parse(Auth::user()->date_credit)->format('d')) {
            $users = User::whereNotNull('salaire_mensuel')->get();  

            foreach ($users as $user) {
             
                $user->salaire_mensuel += $user->salaire_mensuel; 
                $user->save();
            }

            $this->info('Salaire ajouté avec succès à tous les utilisateurs.');
        } else {
            $this->info("Aujourd'hui n'est pas le 10, pas de salaire ajouté.");
        }
    }
}
