<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class VisitorsMiddleware
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
        //check if the user is not logged in
        if(!Sentinel::check()) {
            return $next($request);
        }else {
            return redirect('/');
        }
    }
}
