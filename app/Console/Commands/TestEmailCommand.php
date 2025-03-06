<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BudgetAlertMail;
use App\Models\User;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email sending functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $testEmail = $this->argument('email') ?? 'test@example.com';

        try {
            // Create a test user
            $testUser = new User([
                'name' => 'Test User',
                'email' => $testEmail,
                'seuil_alerte_global' => 80,
                'salaire_mensuel' => 1000
            ]);

            // Test percentage
            $testPourcentage = 85;

            // Send test email
            Mail::to($testEmail)->send(new BudgetAlertMail($testUser, $testPourcentage));

            $this->info('✅ Email de test envoyé avec succès à ' . $testEmail);
            $this->info('Vérifiez votre boîte de réception!');
            
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de l\'envoi de l\'email:');
            $this->error($e->getMessage());
            
            // Additional debugging information
            $this->line('');
            $this->info('🔍 Vérifiez les points suivants:');
            $this->line('- Configuration SMTP dans le fichier .env');
            $this->line('- Existence du template email dans resources/views/emails/budget-alert.blade.php');
            $this->line('- Connection internet active');
        }
    }
}
