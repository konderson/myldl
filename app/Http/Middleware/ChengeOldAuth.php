<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Mail\ChengePasw; 
use Illuminate\Support\Facades\Mail;
class ChengeOldAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$user=User::where('email',$request->email)->where('old_auth',1)->first();
		if(isset($user->email))
		{
		 Mail::to($user->email)->send(new ChengePasw($user));	
		 
		 return redirect('/notify/chenge_password');
		}
		
        return $next($request);
    }
}
