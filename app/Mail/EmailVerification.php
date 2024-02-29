<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $first_name;
    public $pin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token,$email,$first_name,$pin)
    {
        $this->token = $token;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->pin = $pin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.email-verification')->subject('Confirm Your Registration at Mihins Academy')->with([
            'token' => $this->token,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'pin' => $this->pin
        ]);
    }
}
