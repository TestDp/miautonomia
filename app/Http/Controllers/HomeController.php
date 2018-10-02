<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $urlinfo = $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        if( $request->user()->hasRole('admin')){
            return view('home');
        }
        if( $request->user()->hasRole('profesor')){
            return redirect('/encuestas');
        }
    }
}
