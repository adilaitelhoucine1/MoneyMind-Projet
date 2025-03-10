<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BudgetAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pourcentageDepense;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $pourcentageDepense)
    {
        $this->user = $user;
        $this->pourcentageDepense = $pourcentageDepense;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Budget Alert Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.budget-alert',
            with: [
                'user' => $this->user,
                'pourcentageDepense' => $this->pourcentageDepense
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Alerte Budget - MoneyMind');
    }
}
