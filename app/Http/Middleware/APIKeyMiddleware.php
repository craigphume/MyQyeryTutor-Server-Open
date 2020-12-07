<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Env;

class APIKeyMiddleware
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
        // Get the API Key from enviorment and check it is valid
        if(!$request->has('apikey') || (Env::get('API_KEY') != $request->get('apikey')))
        {
            return response()->json(['error'=> 401, 'message' => 'Invalid api key'], 401 );
        }

        return $next($request);
    }
}
