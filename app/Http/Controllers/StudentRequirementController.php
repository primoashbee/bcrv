<?php

namespace App\Http\Controllers;

use App\User;
use App\Requirement;
use App\Events\MyEvent;
use App\StudentRequirement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Notifications\StudentRequirementUpdatedNotification;

class StudentRequirementController extends Controller
{
    
    public function store(Request $request)
    {
        $user = Sentinel::getUser();
        foreach($request->file('requirement') as $key=>$file){
            // Storage::disk('requirements')->put('ashbee.png', $file,'ashbee.png');
            $requirement  = Requirement::find($key)->name;
            $email = Sentinel::getUser()->email;
            $filename = "$email/$user->first_name - $requirement.png";


            Storage::disk('requirements')->putFileAs(
                '',
                $file,
                $filename
              );

            User::find($user->id)->studentRequirements()->where('requirement_id', $key)
              ->update([
                'status' => StudentRequirement::PENDING,
                'path'   => $email,
                'filename' => "$user->first_name - $requirement.png"
              ]);
            
        }


    }

    public function index(Request $request)
    {
        event(new MyEvent('hello world'));

        $list = StudentRequirement::with('requirement','student')
        ->when($request->has('requirement_id'), function($q, $data){
            $q->where('requirement_id', $data);
        })
        ->when($request->has('q'), function($q, $data){
            $q->orWhere('filename', 'like', '%' . $data . '%');
        })
        ->when($request->has('status'), function($q, $data){
            $q->where('status', $data);
        })
        ->paginate(10);

        return view('admin.requirements.student-requirements', compact('list'));
    }

    public function download(Request $request, $id)
    {

        $requirement = StudentRequirement::findOrFail($id);
        
        $headers = array(
          'Content-Type: application/pdf',
        );
        $file = $requirement->directory;
        $filename = $requirement->filename;

       return response()->download($file, $filename, $headers);
    }

    public function update(Request $request, $id){
      
      $request->validate([
        'status'=>['required', Rule::in(StudentRequirement::STATUS_RULES)]
      ]);

      $requirement = StudentRequirement::findOrFail($id);
      
      $requirement->update([
        'status'=>$request->status
      ]);

      $requirement->fresh();
      $requirement->student->notify(new StudentRequirementUpdatedNotification($requirement));

      return redirect()->back();
    }
}
