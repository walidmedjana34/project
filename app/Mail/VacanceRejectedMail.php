<?php

namespace App\Mail;
use App\Models\Vacance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VacanceRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vacance;

    public function __construct(Vacance $vacance)
    {
        $this->vacance = $vacance;
    }

    public function build()
    {
        return $this->subject('Votre annonce a été refusée')
                    ->view('emails.vacance_rejected');
    }
}
