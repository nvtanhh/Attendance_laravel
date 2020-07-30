<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActiveAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $key, $name)
    {
        $this->email = $email;
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Greenteawindowsservice@gmail.com')
            ->view('mail.activeAccount')
            ->subject("DHNL")
            ->with([
                'email' => $this->email,
                'key' => $this->key,
                'name' => $this->name
            ]);
    }
}
