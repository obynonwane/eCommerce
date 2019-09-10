<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //
    protected $fillable = [
        'user_id', 'amount_deposited',
    ];


    public function users()
    {
        return $this->belongsTo('App\User');
    }


}
