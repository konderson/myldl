<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChengePasw extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 private $user;
    public function __construct($user)
    {
       $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
		
         $activationLink = route('chenge_password', [
            'id' => $this->user->id, 
            'token' => md5($this->user->email)
        ]);

        return $this
		->from('larmyldl@mail.com')
		->subject('Создание нового пароля на сайт')
        ->view('email.check_pw')->with([
                'link' => $activationLink
            ]);
    }
}
