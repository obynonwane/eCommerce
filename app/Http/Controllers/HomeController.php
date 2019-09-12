<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\User;
use Auth;
use DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home');
    }


    //display Individuals Deposits History
    public function deposits(){
        return Deposit::all()->where('user_id', Auth::user()->id)->toArray();
    }


    //fetch User Profile details
    public function getProfile(){
        $profile = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

            return response()->json($profile);
    }
}
