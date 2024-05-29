<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class McuSendMail extends Mailable
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
        if($this->record->status == 1){
            $mail = $this->subject('Medical Check Up Result')->view('mails.partials.mcu-mail');
        }else if($this->record->status == 2){
            $mail = $this->subject('Medical Check Up Appointment')->view('mails.partials.mcu-mail');
        }else{
            $mail = $this->subject('Medical Check Up Action Result')->view('mails.partials.mcu-mail');
        }

        return $mail;
    }
}
