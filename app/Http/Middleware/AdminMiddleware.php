<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AdminMiddleware
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
        /**
         * Developer's Comment - Rommel Jake Merca
         *  this method is for our AdminMiddleware to let the Sentinel check if the user is logged in
         *  if yes, then it will check the current user's role,
         *  if the user is for example 'Admin' it do its thing
         * 
         *  I WILL MODIFY IT LATER 
         */

        //check if the user is logged in and if the user has 'Admin' role
        // if(Sentinel::check() && Sentinel::getUser()->roles->first()->name == 'Admin') {
        //     // $roles = Sentinel::getUser()->roles->first();
        //     /* foreach($roles as $role) {
        //         if($role->name == 'Admin'){
        //             return $next($request); 
        //         }
        //     }
        //     return redirect('/');
        //     */
        //     return redirect(url('/dashboard'));
        // }else {
        //     return redirect('/');
        // }

        // Condition for user authentication - if admin -> dashboard else user -> homepage
        if(Sentinel::check() && Sentinel::getUser()->roles->id == '1') {
            return redirect('/dashboard');
        }
        else {
            return redirect('/guest')->with('status', 'You do not have admin privelege');
        }
        
    }
}
