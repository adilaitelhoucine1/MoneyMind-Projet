<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Depense;
use Illuminate\Database\Seeder;

class TestAlertSeeder extends Seeder
{
    public function run()
    {
        // Créer un utilisateur test
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'salaire_mensuel' => 10000,
            'seuil_alerte_global' => 80,
        ]);

        // Créer des dépenses qui dépassent le seuil
        Depense::factory()->create([
            'user_id' => $user->id,
            'prix' => 8500,
            'description' => 'Dépense test'
        ]);
    }
} 