<?php

namespace App\Http\Middleware;

use Closure;

class StudentProfileSetupFinished
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
      
        if(!auth()->user()->profile_setup_finished){
            return redirect()->route('profile.guard-form');
        }
        return $next($request);
    }
}
