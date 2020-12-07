<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'school_id', 'user_id'];

    public function students() {
        return $this->hasMany('App\Student');
    }

    public function results() {
        return $this->hasMany('App\Result');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
