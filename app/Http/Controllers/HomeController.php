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
    public function index()
    {   

        if((\Session::get('user.role')) == 1){
          //  @isAd = "admin";
        }else{
          //  @isAd = "staff";
        }
        
        return view('home',['isAd'=>"admin"]);
    }
}
