<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name', 'contact', 'email', 'address', 'phone'];

    protected $dates = ['expiry', 'disabled'];

    public function subscriptions() {
        return $this->hasMany('App\Subscription')->orderByDesc('enddate');
    }

    public function user() {
        return $this->hasMany('App\User');
    }

//    public function isExpired() {
//        // get the subscriptions and find the latest one
//
//    }
//
//    public function currentSubscription() {
//
//        // get the current subscription
//        return Subscription::where('school_id', $this->id)
//            ->where('startdate', '<', Carbon::now())
//            ->where('enddate', '>=', Carbon::now())
//            ->first();
//    }
}
