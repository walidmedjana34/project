<?php

namespace App\Mail;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;

    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre visite')
                    ->view('emails.visit_confirmed')
                    ->with([
                        'visit' => $this->visit
                    ]);
    }
}
