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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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

        return $this->from('example@example.com')
        ->view('email.vertify')->with([
                'link' => $activationLink
            ]);
    }
}