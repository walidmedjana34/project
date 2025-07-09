<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Agency;
class AgencyRefusedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agency;

    public function __construct(Agency $agency)
    {
        $this->agency = $agency;
    }

    public function build()
    {
        return $this->subject('Votre agence n’a pas été approuvée')
                    ->view('emails.agency_refused');
    }
}
