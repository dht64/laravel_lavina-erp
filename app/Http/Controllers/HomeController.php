<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->isBowner()) {
              return redirect('/bowner');
            } elseif (Auth::user()->isManager()) {
                return redirect('/manager');
              } elseif (Auth::user()->isAdmin()) {
                  return redirect('/admin');
                } elseif (Auth::user()->isEmployee()) {
                    return redirect('/orders');
                  } else {
                      return view('home');
                    } 
        } 
    }
}
