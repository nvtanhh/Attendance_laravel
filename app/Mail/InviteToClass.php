<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteToClass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name =$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Greenteawindowsservice@gmail.com')
            ->view('mail.inviteToClass')
            ->subject("INVITE TO CLASS")
            ->with([
                'email' => $this->email,
                'name'=>$this->name,
                'password' => $this->password
            ]);
    }
}
