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
		if(Auth::user()->person->active==1)
		{
			 return $next($request);
        }
		if(Auth::user()->person->active==2)//заблакирован админом
		{
			  return redirect('/error/block');   
        }
		if(Auth::user()->person->active==3)//заблакирован user
		{
			  return redirect('/error/ublock');   
        }
       if(Auth::user()->person->active==4)//заблакирован user
		{
			  return redirect('/error/delete');   
        }
        
       
    
    }
	 return $next($request);
}
}