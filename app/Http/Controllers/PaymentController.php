<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\User;
use Auth;
use App\Deposit;
class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        
        //dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want


        if($paymentDetails['data']['status'] != 'success'){
            Session::flash('warning', 'Transaction Failed');
            return redirect()->back();
          }

          //update the User Table for current balance
          User::where('id', $paymentDetails['data']['metadata']['user_id'])
          ->update([
            'current_balance' => Auth::user()->current_balance + $paymentDetails['data']['metadata']['amount']
          ]);
           

          $deposits = Deposit::create([
            'user_id'=>$paymentDetails['data']['metadata']['user_id'], 
            'amount'=>$paymentDetails['data']['metadata']['amount'],
            'status'=>$paymentDetails['data']['status'],
            'domain'=>$paymentDetails['data']['domain'],
            'reference'=>$paymentDetails['data']['reference'],
            'gateway_response'=>$paymentDetails['data']['gateway_response'],
            'paid_at'=>$paymentDetails['data']['paid_at'],
            'payment_method'=>$paymentDetails['data']['channel'],
            'currency'=>$paymentDetails['data']['currency']
          ]);
          
          return redirect()->back();

    }
}