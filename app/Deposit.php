<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //
    protected $fillable = [
        'user_id', 'amount','status','domain','reference','gateway_response','paid_at','payment_method','currency'
    ];


    public function users()
    {
        return $this->belongsTo('App\User');
    }


}
