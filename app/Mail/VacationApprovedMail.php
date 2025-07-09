<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vacance;
class VacationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vacance;

    public function __construct(Vacance $vacance)
    {
        $this->vacance = $vacance;
    }

    public function build()
    {
        return $this->subject('Votre annonce vacances a été approuvée')
                    ->view('emails.vacation_approved');
    }
}