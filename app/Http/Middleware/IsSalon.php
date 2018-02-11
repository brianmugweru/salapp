<?php

namespace App\Http\Middleware;

use Closure;

class IsSalon
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
        if(\Auth::User() && \Auth::User()->role == "salon")
        {
            return $next($request);
        }

        return redirect()->login();
    }
}
