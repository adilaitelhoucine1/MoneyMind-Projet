<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Depense;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BudgetAlertNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckSeuilBudjetTest extends TestCase
{
    use RefreshDatabase;

    public function test_alerte_envoyee_quand_seuil_depasse()
    {
        // Désactiver l'envoi réel des notifications
        Notification::fake();

        // Créer un utilisateur de test
        $user = User::factory()->create([
            'salaire_mensuel' => 10000,
            'seuil_alerte_global' => 80, // 80% du salaire
        ]);

        // Créer une dépense qui dépasse le seuil
        Depense::factory()->create([
            'user_id' => $user->id,
            'prix' => 9000 // 90% du salaire
        ]);

        // Exécuter la commande
        $this->artisan('app:check-seuil-budjet');

        // Vérifier que la notification a été envoyée
        Notification::assertSentTo(
            $user,
            BudgetAlertNotification::class
        );

        // Vérifier que l'alerte a été créée dans la base de données
        $this->assertDatabaseHas('alertes', [
            'user_id' => $user->id,
            'type' => 'budget_bas',
            'est_lu' => false
        ]);
    }

    public function test_pas_alerte_quand_seuil_non_depasse()
    {
        Notification::fake();

        $user = User::factory()->create([
            'salaire_mensuel' => 10000,
            'seuil_alerte_global' => 80,
        ]);

        Depense::factory()->create([
            'user_id' => $user->id,
            'prix' => 7000 // 70% du salaire
        ]);

        $this->artisan('app:check-seuil-budjet');

        Notification::assertNotSentTo(
            $user,
            BudgetAlertNotification::class
        );
    }

    public function test_pas_alerte_quand_seuil_non_defini()
    {
        Notification::fake();

        $user = User::factory()->create([
            'salaire_mensuel' => 10000,
            'seuil_alerte_global' => 0, // seuil non défini
        ]);

        Depense::factory()->create([
            'user_id' => $user->id,
            'prix' => 9000
        ]);

        $this->artisan('app:check-seuil-budjet');

        Notification::assertNotSentTo(
            $user,
            BudgetAlertNotification::class
        );
    }
} 