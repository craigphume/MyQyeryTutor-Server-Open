<?php

namespace App\Http\Middleware;

use App\Classroom;
use Closure;

class CheckClassCode
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
        if(!Classroom::where('code', $request->get('classcode'))->first())
        {
            return response()->json("error", 401);
        }

        return $next($request);
    }
}
