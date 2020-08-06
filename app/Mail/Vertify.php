<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Vertify extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
	protected $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$pass)
    {
        $this->user = $user;
		 $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $activationLink = route('activation', [
            'id' => $this->user->id, 
            'token' => md5($this->user->email)
        ]);
            $name=$this->user->name;
			$pass=$this->pass;
			$email=$this->user->email;
        return $this
		->from('larmyldl@mail.com')
		->subject('ЛДЛ: Подтвердите регистрацию на сайте')
        ->view('email.vertify')->with([
                'link' => $activationLink,
				'name'=>$name,
				'pass'=>$pass,
				'email'=>$email
            ]);
    }
}