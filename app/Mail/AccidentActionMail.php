<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccidentActionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $record;
    public $title;
    public $urls;
    public $subtitle;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($record, $title,$urls,$subtitle)
    {
        $this->record = $record;
        $this->title = $title;
        $this->urls = $urls;
        $this->subtitle = $subtitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject('Accident Recommendation & Action Plan')->view('mails.partials.accident-action');

        return $mail;
    }
}
