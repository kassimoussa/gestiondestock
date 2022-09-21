<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $rand;

    public function __construct($rand)
    {
        $this->rand = $rand;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $rand = $this->rand;
        return $this->view('emails.reset_password')->subject("Réinitialisation de mot de passe !")->with(compact('rand'));
    }
}
