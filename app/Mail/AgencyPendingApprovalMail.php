<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Agency;
class AgencyPendingApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agency;

    public function __construct(Agency $agency)
    {
        $this->agency = $agency;
    }

    public function build()
    {
        return $this->subject('Confirmation d’enregistrement de votre agence')
                    ->view('emails.agency_pending_approval');
    }
}