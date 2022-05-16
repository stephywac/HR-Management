<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminCheck
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
        if(Auth::user())
        {
            if (Auth::user()->user_type==1) { 
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect('/login');
            }
        }
        return redirect('/login');
        
        
        
       
    }
}
