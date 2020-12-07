<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSchoolEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //dd(Auth::user());
        if(Auth::user()->school->disabled)
        {
            Auth::logout();
            return redirect('login')->with('error', 'School is currently disabled');
        }

        return $next($request);
    }
}
