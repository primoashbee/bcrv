<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use Validator;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class LoginController extends Controller
{
    // protected function redirectTo() {
    //     if(Sentinel::check() && Sentinel::getUser()->roles->first()->name == 'Admin') {
    //         return '/';
    //     }
    //     else {
    //         return '/guest';
    //     }
    //  }

    // function for showing login view
    public function login() {
        //if user already logged in return the user to dashboard or home
        if(Sentinel::check()){
            // return redirect('/dashboard');
            if(Sentinel::getUser()->roles->first()->name == 'Admin'){
                return redirect(url('/show_dashboard'));
            }else{
                return redirect(url('/show_dashboard_students'));
            }
        }
        return view('new_login_and_registration.logReg');
    }

    //function for the login action
    public function loginUser(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //if the validator succeed and remember is on
        if($request->remember == 'on'){
            try{
                $user = Sentinel::authenticateAndRemember($request->all());
            }catch(ThrottlingException $e){
            //Throttle checks if the user enters a wrong password 3 times and will not let the user login for a given time
                $delay = $e->getDelay();
                $returnData = array(
                    'status' => 'error',
                    'message' => 'You entered a wrong password for 3 times.',
                    //throw errors of the validators
                    'errors' => ["You can login again in $delay seconds."]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error' => "You can login again in $delay seconds."]);
            }catch(NotActivatedException $e){
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Account not Verified',
                    //throw errors of the validators
                    'errors' => ["Please activate your account first"]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error' => "Please activate your account first"]);
            }
        }else{
            //if the validator succeed and remember is off
            try{
                $user = Sentinel::authenticate($request->all());
            }catch(ThrottlingException $e){
            //Throttle checks if the user enters a wrong password 3 times and will not let the user login for a given time
                $delay = $e->getDelay();
                $returnData = array(
                    'status' => 'error',
                    'message' => 'You entered a wrong password for 3 times.',
                    //throw errors of the validators
                    'errors' => ["You can login again in $delay seconds."]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error' => "You can login again in $delay seconds."]);
            }catch(NotActivatedException $e){
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Account may not be activated.',
                    //throw errors of the validators
                    'errors' => ["Please activate your account first"]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error' => "Please activate your account first"]);
            }
        }
        
        //if the user successfully logged in 
        if(Sentinel::check()){
            // return redirect('/dashboard');
            if(Sentinel::getUser()->roles->first()->name == 'Admin'){
                return redirect(url('/show_dashboard'));
            }else{
                return redirect(url('/show_dashboard_students'));
            }
        }else{
            $returnData = array(
                'status' => 'error',
                'message' => 'Login failed',
                //throw errors of the validators
                'errors' => ["Email or Password mismatched."]
            );
            // return response()->json($returnData, 500);
            return redirect()->back()->with(['error' => "Email or Password mismatched."]);
        }
    }

    //function for logout
    public function logout() {
        Sentinel::logout();
        return redirect(url('/'));
    }
}
