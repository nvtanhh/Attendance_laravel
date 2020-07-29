<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActiveAcount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(  $email,$key ) {
        $this->email =$email;
        $this->key=$key;
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
                'key'=>$this->key]);
    }
}
