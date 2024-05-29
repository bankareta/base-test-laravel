<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EquipmentEmail extends Mailable
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
     public function __construct($record,$title,$urls,$subtitle)
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
        $mail = $this->subject('Equipment')->view('mails.partials.equipment');
        if(isset($this->fileurl))
        {
            if(file_exists(storage_path().'/app/public/'.$this->fileurl))
            {
                $mail->attach(storage_path('app/public/'.$this->fileurl));
            }
        }

        return $mail;
    }
}
