<?php

namespace App\Http\Controllers;

use App\User;
use App\Requirement;
use App\StudentRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class StudentRequirementController extends Controller
{
    
    public function store(Request $request)
    {
        $user = Sentinel::getUser();
        foreach($request->file('requirement') as $key=>$file){
            // Storage::disk('requirements')->put('ashbee.png', $file,'ashbee.png');
            $requirement  = Requirement::find($key)->name;
            $email = Sentinel::getUser()->email;
            $filename = "$email/$email - $requirement.png";


            Storage::disk('requirements')->putFileAs(
                '',
                $file,
                $filename
              );

            User::find($user->id)->studentRequirements()->where('requirement_id', $key)
              ->update([
                'status' => StudentRequirement::PENDING,
                'path'   => $email,
                'filename' => "$email - $requirement.png"
              ]);
            
        }


    }

}
