<?php

namespace App;

use App\Jobs\SendEmail;
use App\Mail\NewTeacherPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function school() {
        return $this->belongsTo('App\School');
    }

    public function classrooms() {
        return $this->hasMany('App\Classroom');
    }

    public function sendWelcomeEmail() {
        $token = app('auth.password.broker')->createToken($this);

        Mail::to($this->email)
            ->queue(new NewTeacherPassword($this, $token));

    }
}
