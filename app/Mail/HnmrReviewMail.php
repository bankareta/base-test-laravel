<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HnmrReviewMail extends Mailable
{
    use Queueable, SerializesModels;
    public $record;
    public $title;
    public $urls;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($record, $title,$urls)
    {
        $this->record = $record;
        $this->title = $title;
        $this->urls = $urls;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject('Hazard / Near Missing')->view('mails.partials.hnmr-review');

        if($this->record->evidences->count() > 0)
        {
            foreach($this->record->evidences as $attachment)
            {
                if(file_exists(storage_path().'/app/public/'.$attachment->filepath))
                {
                    $mail->attach(storage_path('app/public/'.$attachment->filepath));
                }
            }
        }

        return $mail;
    }
}
