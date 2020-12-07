<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['firstname','lastname','email','classroom_id'];


    public function classroom() {
        return $this->belongsTo('App\Classroom');
    }

    public function results() {
        return $this->hasMany('App\Result');
    }

    public function fullname() {

        return $this->lastname . ', ' . $this->firstname;
    }
}
