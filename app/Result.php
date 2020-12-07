<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    protected $fillable = ['topic', 'question', 'query', 'pass', 'attempts', 'student_id', 'classroom_id', 'ip'];

    public function classroom() {
        return $this->belongsTo('App\Classroom');
    }

    public function student() {
        return $this->belongsTo('App\Student');
    }
}
