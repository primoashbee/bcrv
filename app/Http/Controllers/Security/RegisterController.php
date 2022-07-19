<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use Activation;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;
use Validator;
use App\User;
use App\Models\Roles\RoleModel;
use App\Models\Roles\UserModel;
use App\Models\User\UserModel as UserUserModel;
use Mail;

class RegisterController extends Controller
{   
    // function to show the registration form view
    public function register() {
        //get all the data from table 'roles'
        $data['roles'] = RoleModel::get();
        return view('new_login_and_registration.logReg')->with('data', $data);
    }

    // function to register the user 
    public function registerUser(Request $request) {
        // student info table
        $studentinfo = new StudentInfoModel();

        $this->validate($request, [
            'first_name' => 'required|max:50',
            'email' => 'unique:users|required|email',
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12'
        ]);

        //to get the ID of roles
        $data = $request->all();
        $roleID = 2;

        // $userModel = new UserUserModel();

        //method for registrationof user to Sentinel
        // $user = Sentinel::register($request->all());
        $user = Sentinel::register(array(
            'email'    => $request->email,
            'password' => $request->password,
            'first_name' => $request->first_name,
        ));

        // $user->user_name = $request->user_name;

        //to Attach the roleID in the user registration
        $role = Sentinel::findRoleByID($roleID);
        $role->users()->attach($user);
        
        //method for activating the user
        $activate = Activation::create($user);
        //method send an Activation code to users' email
        $this->sendActivationEmail($user, $activate->code);
        $returnData = array(
            'status' => 'success',
            'message' => 'Verify your account first',
            //throw errors of the validators
            'errors' => ["Please activate your account first"]
        );

        $student_info_table = StudentInfoModel::select('alternate_id as alternate_id')->orderBy('created_at', 'desc')->first();
        $studentinfo->alternate_id = $student_info_table->alternate_id + 1;
        $studentinfo->email = $request->email;
        $studentinfo->name = $request->first_name;
        $studentinfo->save();
        
        return redirect()->back()->with(['success' => "Registered Successfully! Verify your email to login."]);
    }
        

    //function for sending Activation email for the user to activate his/her account
    public function sendActivationEmail($user, $code) {
        Mail::send(
            'email.activation',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("Hi there! $user->first_name", "Please Activate your Email.");
            }
        );
    }
}
