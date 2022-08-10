<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class StudentMiddleware
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
        
        if(!Sentinel::check()){
            abort(403);
        }
        if(Sentinel::getUser()->roles->first()->id != '2') {
            abort(403);
        }
        return $next($request);
    }
}
