<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BudgetAlertNotification extends Notification
{
    use Queueable;

    protected $pourcentageDepense;
    protected $seuilAlerte;

    public function __construct($pourcentageDepense, $seuilAlerte)
    {
        $this->pourcentageDepense = $pourcentageDepense;
        $this->seuilAlerte = $seuilAlerte;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Alerte de dépassement de budget')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Nous avons détecté un dépassement de votre seuil budgétaire.')
            ->line("Vos dépenses actuelles représentent {$this->pourcentageDepense}% de votre budget mensuel.")
            ->line("Votre seuil d'alerte est fixé à {$this->seuilAlerte}%.")
            ->action('Voir mes dépenses', url('/depenses'))
            ->line('Merci de surveiller vos dépenses !');
    }

    public function toArray($notifiable)
    {
        return [
            'pourcentage_depense' => $this->pourcentageDepense,
            'seuil_alerte' => $this->seuilAlerte,
            'message' => "Vos dépenses ({$this->pourcentageDepense}%) ont dépassé votre seuil d'alerte ({$this->seuilAlerte}%)"
        ];
    }
} 