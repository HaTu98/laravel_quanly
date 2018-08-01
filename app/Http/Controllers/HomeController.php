<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        //dd(Auth::user()->isAdmin);
        if ((\Session::get('user.role')) == 1) {
            //  @isAd = "admin";
        } else {
            //  @isAd = "staff";
        }

        return view('home', ['isAd' => "admin"]);
    }
}
