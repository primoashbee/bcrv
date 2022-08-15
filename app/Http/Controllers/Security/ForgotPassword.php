<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use Reminder;
use App\User;
use Mail;

class ForgotPassword extends Controller
{
    // function for showing the forgot password view
    public function forgot() {
        return view('new_login_and_registration.forgot');
    }

    // function for the forgot password action
    public function forgot_password(Request $request) {
        $user = User::whereEmail($request->email)->first();

        //if no user found
        if($user == null){
            return redirect()->back()->with(['error' => 'Email doesnt exist']);
        }

        //get the data using sentinel
        $user = Sentinel::findById($user->id);
        //check if the reminder already exists, if not create the reminder
        $reminder = Reminder::exists($user) ? :Reminder::create($user);
        //after creating the reminder, send email to the email address
        $this->sendEmail($user, $reminder->code);

        return redirect()->back()->with(['success' => 'Reset password code have been sent to your email.']);
    }

    //function for sending email to user - for reset password purpose
    public function sendEmail($user, $code) {
     
        Mail::send(
            'email.forgot',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->first_name, Here is your reset password link.");
            }
        );
    }

    //function for the reset password
    public function reset($email, $code) {
        $user = User::whereEmail($email)->first();

        //if no user found
        if($user == null){
            echo 'Email doesnt exist';
        }

        //get the data using sentinel
        $user = Sentinel::findById($user->id);
        //check if the reminder already exists, if not create the reminder
        $reminder = Reminder::exists($user);

        if($reminder){
            //check if the code we have matches that in the database based on the user
            if($code == $reminder->code){
                return view('new_login_and_registration.reset_password_form')->with(['user' => $user, 'code' => $code]);     
            }else{
                return redirect('/');
            }
        }else{
            echo 'Your session has expired.';
        }
    }

    //function for posting new password to database
    public function reset_password(Request $request, $email, $code) {
        //form Validation
        $this->validate($request, [
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12'
        ]);
        
        $user = User::whereEmail($email)->first();
        //if no user found
        if($user == null){
            echo 'Email doesnt exist';
        }
        
        //get the data using sentinel
        $user = Sentinel::findById($user->id);
        //check if the reminder already exists, if not create the reminder
        $reminder = Reminder::exists($user);

        if($reminder){
            //check if the code we have matches that in the database based on the user
            if($code == $reminder->code){
                //if the code match, complete the reminder, together with the user, code, and the new password
                Reminder::complete($user, $code, $request->password);
                return redirect('/login')->with('success', 'Success! Please login with your new password.');
            }else{
                return redirect('/');
            }
        }else{
            echo 'Your session has expired.';
        }
    }
}
