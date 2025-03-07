<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\BudgetAlertMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        try {
            // Log current mail configuration
            Log::info('Testing email configuration', [
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from_address' => config('mail.from.address'),
            ]);

            // Create test user
            $testUser = new User([
                'name' => 'Test User',
                'email' => 'adil.ait.2003@gmail.com',
                'seuil_alerte_global' => 80,
                'salaire_mensuel' => 1000
            ]);

            // Send test email
            Mail::raw('Test email from MoneyMind at ' . now(), function($message) {
                $message->to('adil.ait.2003@gmail.com')
                        ->subject('Test Email MoneyMind');
            });

            // If raw email works, try sending the actual template
            Mail::to('adil.ait.2003@gmail.com')
                ->send(new BudgetAlertMail($testUser, 85));

            Log::info('Email sending completed');

            return response()->json([
                'message' => 'E-mail envoyé avec succès !',
                'details' => [
                    'to' => 'adil.ait.2003@gmail.com',
                    'user' => $testUser->name,
                    'percentage' => 85
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Erreur lors de l\'envoi de l\'email',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}
