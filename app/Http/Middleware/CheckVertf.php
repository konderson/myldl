<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Route;
class CheckVertf
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
            
            if(Auth::user()->token==null && Auth::user()->verified!=1 )
        {
            if(Route::getFacadeRoot()->current()->uri()!=='error/auth' ||Route::getFacadeRoot()->current()->uri()!=='logout' )
            {
             return redirect('/error/auth');   
            }
            
        }
        }
       
         return $next($request);
       
    
    }
}