<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Str;

class RefreshApiToken
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
        if ($loggedUser = Auth::user()) {
            $loggedUser->api_token = Str::random(60);
            $loggedUser->save();
        }
        return $next($request);
    }
}
