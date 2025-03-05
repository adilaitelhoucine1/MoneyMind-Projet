<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Auth; 

use Carbon\Carbon;
use App\Models\User;

use Illuminate\Console\Command;

class AddSalary extends Command
{
    protected $signature = 'salary:add';
    protected $description = 'Ajoute le salaire mensuel aux utilisateurs';

    public function __construct()
    {
        parent::__construct();
    }

  

     public function handle()
     {
         $today = Carbon::now()->day; 
 
         $users = User::whereNotNull('salaire_mensuel')
                      ->whereNotNull('date_credit')
                      ->get();


         foreach ($users as $user) {
             if ($today == 5) {
                 $user->Budjet+=$user->salaire_mensuel;
                 $user->save();
                 $this->info("Salaire ajouté pour : {$user->name}");
             }else{
                $this->info(' ⚠️   C est pas Le jour.');
             }
         }
 
         $this->info('✅ Traitement terminé.');
     }
}
