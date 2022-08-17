<?php

namespace App\Http\Controllers;

use App\User;
use App\Requirement;
use App\Events\MyEvent;
use App\StudentRequirement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use App\Events\StudentRequirementUploadedEvent;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Notifications\StudentRequirementUpdatedNotification;
use App\Notifications\StudentRequirementUploadedNotification;

class StudentRequirementController extends Controller
{
    
    public function store(Request $request)
    {
        $user = Sentinel::getUser();
        $email = $user->email;

        $student = User::find($user->id);
        $admin = User::find(1);
        foreach($request->file('requirement') as $key=>$file){
            // Storage::disk('requirements')->put('ashbee.png', $file,'ashbee.png');
            $requirement  = Requirement::find($key)->name;
            $filename = "$email/$user->first_name - $requirement.png";


            Storage::disk('requirements')->putFileAs(
                '',
                $file,
                $filename
              );

            $student_requirement = $student->studentRequirements()->where('requirement_id', $key)->first();
            $student_requirement->update([
                'status' => StudentRequirement::PENDING,
                'path'   => $email,
                'filename' => "$user->first_name - $requirement.png"
            ]);
            $admin->notify(new StudentRequirementUploadedNotification($student_requirement, true));

            $student->notify(new StudentRequirementUploadedNotification($student_requirement));
            
        }

        return redirect()->back();


    }

    public function index(Request $request)
    {
        $list = StudentRequirement::has('requirement')
                                  ->has('student')
                                  ->with('requirement','student')
                                  ->when($request->has('requirement_id'), function($q, $data) use ($request){
                                      $q->where('requirement_id', $request->requirement_id);
                                  })
                                  ->when($request->has('q'), function($q, $data)  use ($request){
                                      $q->orWhere('filename', 'like', '%' . $request->q . '%');
                                  })
                                  ->when($request->has('status'), function($q, $data)  use ($request){
                                      $q->where('status', $request->status);
                                  })
                                  ->paginate(10);

        $requirement = $request->has('id') ? StudentRequirement::with('student','requirement')->findOrFail($request->id) : null ;
        return view('admin.requirements.student-requirements', compact('list','requirement'));
    }

    public function download(Request $request, $id)
    {

        $requirement = StudentRequirement::findOrFail($id);
        
        $headers = array(
          'Content-Type: application/pdf',
        );
        $file = $requirement->directory;
        $filename = $requirement->filename;
        return Storage::disk('requirements')->download($requirement->path . '/' . $requirement->filename);
          
        // return (new Response($nF, 200))
        //       ->header('Content-Type', 'image/jpeg');
       return response()->download($nF, $filename, $headers);
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

      return redirect()->route('requirements.uploaded');
    }

    public function view(Request $request, $id){
      $requirement = StudentRequirement::findOrFail($id);
        
      $headers = array(
        'Content-Type: application/pdf',
      );
      $file = $requirement->directory;
      $filename = $requirement->filename;
      $src = "https://placehold.co/1200";

      $path = Storage::disk('requirements')->path($requirement->path . '/' . $requirement->filename);
      return response()->file($path, $headers);
      return view('preview', compact('src'));
      // return Storage::disk('requirements')->get($requirement->path . '/' . $requirement->filename);
    }
}
