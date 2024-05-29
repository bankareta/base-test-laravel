<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HnmrUpdateReviewMail extends Mailable
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
     public function __construct($record, $title, $urls, $subtitle)
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
        $mail = $this->subject('Hazard / Near Missing')->view('mails.partials.hnmr-update');

        if($this->record->evidences->count() > 0 && $this->record->published == 1)
        {
            foreach($this->record->evidences as $attachment)
            {
                if(file_exists(storage_path().'/app/public/'.$attachment->filepath))
                {
                    $mail->attach(storage_path('app/public/'.$attachment->filepath));
                }
            }
        }

        if($this->record->solvedpics->count() > 0 && $this->record->published == 3)
        {
            foreach($this->record->solvedpics as $pic)
            {
                if(file_exists(storage_path().'/app/public/'.$pic->filepath))
                {
                    $mail->attach(storage_path('app/public/'.$pic->filepath));
                }
            }
        }

        return $mail;
    }
}
