<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
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
        
        if(Auth::check()){
            if(!empty(Auth::user()->role)){
                 return $next($request);
            }
            else{
                Auth::logout();
                 return redirect('/error/auth');
            }
        }
        else{
           // return route('login');
              return redirect('/error/auth');
        }
         return $next($request);
       
    }
}