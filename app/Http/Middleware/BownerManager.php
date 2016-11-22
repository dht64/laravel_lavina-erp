<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BownerManager
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
        
        if (Auth::check()) {
            if (Auth::user()->isBowner() || Auth::user()->isManager()) {
                return $next($request);        
            }
        }
        return redirect('/login');
    }
}
