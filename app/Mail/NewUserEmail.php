<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Welcome to YourApp!')
            ->view('emails.new_user') // Blade view for the email content
            ->with(['token' => $this->token]); // Pass data to the view
    }
}
