<?php

namespace App\Http\Middleware;

use App\Classroom;
use Closure;
use Illuminate\Support\Facades\Auth;

class UsersClassroom
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
        $school_id = Auth::user()
            ->school_id;

        $classes_ids = Classroom::where('school_id', $school_id)
            ->get()
            ->pluck('id');

        if(!$classes_ids->contains($request->id))
        {
            abort(404);
        }

        return $next($request);
    }
}
