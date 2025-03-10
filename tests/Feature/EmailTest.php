<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Depense;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_reel()
    {
        // Créer un utilisateur avec votre email
        $user = User::factory()->create([
            'email' => 'votre-email@example.com',
            'salaire_mensuel' => 10000,
            'seuil_alerte_global' => 80,
        ]);

        Depense::factory()->create([
            'user_id' => $user->id,
            'prix' => 9000
        ]);

        // Exécuter la commande
        $this->artisan('app:check-seuil-budjet');
    }
} 