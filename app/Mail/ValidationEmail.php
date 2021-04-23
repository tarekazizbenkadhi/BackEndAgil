<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->validation_mail_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('agil.app2021@gmail.com', 'Agil')
            ->subject('validation Compte Agil')
            ->view('Mail.validation-email',['mail_data'=>$this->validation_mail_data]);
    }
}
