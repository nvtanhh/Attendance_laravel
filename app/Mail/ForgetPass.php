<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPass extends Mailable {
    use Queueable, SerializesModels;

    protected $email;
    protected $key;
    protected $name;

    public function __construct( $email, $key ) {
        $this->email = $email;
        $this->key   = $key;
    }

    /**
     * Build the message.a
     *
     * @return $this
     */
    public function build() {
//			$this->subject('QUÊN MẬT KHẨU');
//
//			return $this->view( 'mail.forgetPass' )->with([
//				'email' => $this->email,
//				'key'=>$this->key,
//				'name'=>$this->name]);
        return $this->from( 'Greenteawindowsservice@gmail.com' )
                    ->view( 'mail.forgetPass' )
                    ->subject( "DHNL" )
                    ->with( [
                        'email' => $this->email,
                        'key'   => $this->key
                    ] );
    }
}
