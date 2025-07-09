<?php
namespace App\Mail;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitRefused extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;

    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function build()
    {
        return $this->subject('Votre visite a été annulée')
                    ->view('emails.visit_refused')
                    ->with([
                        'visit' => $this->visit
                    ]);
    }
}

