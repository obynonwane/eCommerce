<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Auth;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return User::latest()->where('id', '!=', Auth::user()->id)->paginate(5);
        //return $users = User::all()->where('id', '!=', Auth::user()->id);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile(){
        return auth('api')->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        //finds your friend and update his/her account
        $receiver = User::findOrFail($id);
        
        //get the amount sent to friend
        $amount_sent = abs($receiver->current_balance - $request->current_balance);

        
        //update friend account balance
        $receiver->current_balance = $request->current_balance;
        $receiver->save();


        //update your new balance after deduction
        $sender = User::findOrFail(Auth::user()->id);
        $sender->current_balance = abs(Auth::user()->current_balance - $amount_sent);
        $sender->save();


        //Insert New transactions table
        $transaction = new Transaction;
        $transaction->sender_id = $sender->id;
        $transaction->receiver_id = $receiver->id;
        $transaction->amount_sent = $amount_sent;
        $transaction->amount_received = $amount_sent;
        $transaction->save();
        

        // $req = $user->update($request->all());
        // $b = $request->current_balance + 10000;
        //return response()->json($sender->current_balance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //search User table 
    public function search(){
                
            if($search = \Request::get('q')){
                $users = User::where(function($query) use ($search){
                    $query->where('name', 'LIKE', '%search%')
                          ->orWhere('email', 'LIKE', "%search%");
                })->paginate(20);
            }
                
        return $users;
    }
}
