<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AdminMiddlewareLegit
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
        
        // return abort(422);
        if(!Sentinel::check()){
            abort(403);
        }
        if(Sentinel::getUser()->roles->first()->id != '1') {
            abort(403);;
        }
        return $next($request);
    }
}
