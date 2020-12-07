<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['startdate', 'enddate', 'number', 'school_id'];

    protected $dates = ['startdate', 'enddate'];

    public function school() {
        return $this->belongsTo('App\School');
    }
}
