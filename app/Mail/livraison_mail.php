<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class livraison_mail extends Mailable
{
    use Queueable, SerializesModels;

    public $validation_mail_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
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
            ->subject('Commande Carburant')
            ->view('Mail.Livraison_mail');
    }
}
