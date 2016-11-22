<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Bowner
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
			if(Auth::user()->isBowner()){
				return $next($request);
			}
		}

        //Session::flash('pre-url', url()->previous());
        //$request->session()->put('pre-url', url()->previous());
        //dd(session('pre-url'));

		return redirect('/login');
    }
}
