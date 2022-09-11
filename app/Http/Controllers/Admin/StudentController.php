<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use App\Requirement;
use App\StudentRequirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;
use App\Notifications\StudentRequirementUploadedNotification;

class StudentController extends Controller
{
    // show students page
    public function show_students() {
        $students = StudentInfoModel::with('user.learner')->get();
        $courses = CourseModel::all();
        return view('admin.students.students')->with('students', $students)
                                            ->with('courses', $courses);
    }

    //  show the page to edit the students
    public function show_edit_student($id){
        $students = StudentInfoModel::findOrfail($id);
        $courses = CourseModel::all();
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        return view('admin.students.edit_student')->with('students', $students)
                                                ->with('batches', $batches)
                                                ->with('years', $years)
                                                ->with('courses', $courses);
    }


    // function for the update students
    public function edit_student(Request $request, $id)
    {
        $students = StudentInfoModel::findOrfail($id);    
        // $students->course = $request->input('course');
        // $students->year = $request->input('year');
        $students->status = $request->input('status');
        $students->batch = $request->input('batch');
        $students->school_year = $request->input('school_year');

        $students->update();
        if(count($request->courses) > 0){
            $students->user->courses()->delete();
            foreach($request->courses as $course_id){
                $students->user->courses()->create(
                    ['course_id'=>$course_id]
                );
            }
        }
        Session::flash('statuscode', 'info');
        return redirect('show_students')->with('status', 'Data Updated Successfully!');
    }

    public function delete($id){
        $student = StudentInfoModel::findOrFail($id);

        $student->delete();
        return response()->json([], 200);
    }

    public function setup()
    {
        $user = auth()->user();
        $courses = CourseModel::select('id','course_name')->orderBy('course_name','desc')->get();
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        $profile = $user->studentInfo;
        $user_courses = $user->courses;
        $profile->courses = $user_courses;


        $level = $user->studentInfo->education_level;

        $list  = Requirement::active()->where('education_level',$level)->get();
        $requirements = $list->pluck('id')->toArray();
        $existing     = $user->studentRequirements->pluck('requirement_id')->toArray();
        $to_add = array_merge(array_diff($requirements, $existing),array_diff($existing, $requirements));
        foreach($to_add as $requirement_id)
        {
            $user->studentRequirements()->create(
                [
                    'requirement_id'=>$requirement_id,
                    'status' => StudentRequirement::MISSING,
                ]);
        }


        $has_leaner = false;
        $learner = $user->learner;
        if(!is_null($learner)){
            
            $has_leaner = $learner->finished;
        }
        $steps = [
            [
                'step'=>1,
                'finished'=> $profile->is_finished
            ],
            [
                'step'=>2,
                'finished'=> $user->requirements_complete
            ],
            [
                'step'=>3,
                'finished'=>$has_leaner
            ]
        ];

        $list = $user->studentRequirements->load('requirement')->each->append('html','date_uploaded');
        return response()->json(compact('courses','batches','years','profile','list','steps'),200);
    }

    public function postSetup(Request $request, $type)
    {
        $user = auth()->user();
        $email = $user->email;
        $student_info = $user->studentInfo;
        $admin = User::find(1);

        if($type=="profile"){
            $request->validate([
                'firstname'=>'required',
                'lastname'=>'required',
                'courses.*'=>'required|exists:courses,id',
                'address'=>'required',
                'contact_number'=>'required',
                'school_year'=>'required',
                'batch'=>'required',
            ]);

            $user->studentInfo->update([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'address'=>$request->address,
                'contact_number'=>$request->contact_number,
                'school_year'=>$request->school_year,
                'batch'=>$request->batch,
                'is_finished'=>true
            ]);
            if(count($request->courses) > 0){
                $user->courses()->delete();
                foreach($request->courses as $course_id){
                    $user->courses()->create(
                        ['course_id'=>$course_id]
                    );
                }
            }
 

            return response()->json(['message'=>'Learner Profile Updated!','finished'=>true]);




        }
        if($type=="requirements"){
            foreach($request->file as $key=>$file)
            {

                $student_requirement = StudentRequirement::find($request->requirement_id[$key]);
                // $requirement  = Requirement::find($key)->name;\
                $requirement_name = $student_requirement->requirement->name;
                $filename = "$email/$student_info->name - $requirement_name.png";
                Storage::disk('requirements')->putFileAs(
                    '',
                    $file,
                    $filename
                  );
    
                // $student_requirement = $user->studentRequirements()->where('requirement_id', $request->requirement_id[$key])->first();
                $student_requirement->update([
                    'status' => StudentRequirement::PENDING,
                    'path'   => $email,
                    'filename' => "$student_info->name - $requirement_name.png",
                    'updated_at' => now()
                ]);
                $admin->notify(new StudentRequirementUploadedNotification($student_requirement, true));
    
                $user->notify(new StudentRequirementUploadedNotification($student_requirement));
                
            }

            if($user->requirements_complete){
                return response()->json([
                    'message'=>'Requirements Completed',
                    'finished'=>true
                ]);
            }
            return response()->json([
                'message'=>'Requirement/s Uploaded',
                'finished'=>false
            ]);
            
        }
    }

}
