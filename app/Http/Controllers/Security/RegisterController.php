<?php

namespace App\Http\Controllers\Security;

use Mail;
use App\User;

use Sentinel;
use Validator;
use Activation;
use Illuminate\Http\Request;
use App\Models\Roles\RoleModel;
use App\Models\Roles\UserModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentInfo;
use App\Notifications\UserAccountNotification;
use App\Models\User\UserModel as UserUserModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;

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
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'unique:users|required|email',
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12',
            'education_level'=> ['required', Rule::in(StudentInfo::EDUCATION_LEVEL)]
        ]);
        
        try{

            DB::beginTransaction();
            //to get the ID of roles
            $data = $request->all();
            $roleID = 2;

            // $userModel = new UserUserModel();

            //method for registrationof user to Sentinel
            // $user = Sentinel::register($request->all());
            // $user = Sentinel::register(array(
            //     'email'    => $request->email,
            //     'password' => $request->password,
            //     'first_name' => $request->first_name,
            // ));
            $user = Sentinel::register(array(
                'email'    => $request->email,
                'password' => $request->password,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname
                
            ));

            // $user->user_name = $request->user_name;

            //to Attach the roleID in the user registration
            $role = Sentinel::findRoleByID($roleID);
            $role->users()->attach($user);
            
            //method for activating the user
            $activate = Activation::create($user);
            //method send an Activation code to users' email
            $returnData = array(
                'status' => 'success',
                'message' => 'Verify your account first',
                //throw errors of the validators
                'errors' => ["Please activate your account first"]
            );

            $alternanate_id = StudentInfoModel::generateAlternateID();
            $studentinfo->alternate_id = $alternanate_id;
            $studentinfo->email = $request->email;
            $studentinfo->firstname = $request->firstname;
            $studentinfo->lastname = $request->lastname;
            $studentinfo->name =  "{$request->firstname} {$request->lastname}";
            $studentinfo->education_level = $request->education_level;
            $studentinfo->save();
            
            $this->sendActivationEmail($studentinfo, $activate->code);

            User::find(1)->notify(new UserAccountNotification(User::find($user->id)));
            DB::commit();

            return redirect()->back()->with(['success' => "Registered Successfully! Verify your email to login."]);

        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
        }

    }
        

    //function for sending Activation email for the user to activate his/her account
    public function sendActivationEmail($user, $code) {
        Mail::send(
            'email.activation',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->from('no-reply@crvschooldocs.online','BCRV');

                $message->subject("Welcome to BCRV!", "Please Activate your Email.");
            }
        );
    }
}
