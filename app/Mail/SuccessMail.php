<?php

namespace App\Mail;
use Illuminate\Mail\Mailable;

class SuccessMail extends Mailable
{

    public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }


  
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Success Mail',
    //     );
    // }

   
    // public function content()
    // {
    //     return new Content(
    //         markdown: 'emails.SuccessMail',
    //     );
    // }

    
    // public function attachments()
    // {
    //     return [];
    // }

    public function build()
    {
        return $this->markdown('emails.SuccessMail')->subject($this->details['subject'])->with('data',$this->details);
    }
}
