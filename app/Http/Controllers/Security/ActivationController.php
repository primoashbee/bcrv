<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use Activation;
use App\User;

class ActivationController extends Controller
{
    //function for user email activation
    public function activate($email, $code) {
        //pass the user id to variable
        $user = User::whereEmail($email)->first();
        $userID = $user->id;
        $user = Sentinel::findById($userID);

        // condition if the user is already activated prompt to login page
        if(Activation::complete($user, $code)){
            return redirect('/login')->with(['success' => "Account Verified! You may now login to your account"]);;
        }
        
    }
}
