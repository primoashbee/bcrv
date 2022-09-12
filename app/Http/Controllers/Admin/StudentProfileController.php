<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\RequestModel as RequestModel;
use App\Models\PrimaryModels\DocumentModel as DocumentModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;

class StudentProfileController extends Controller
{
   // show profile page 
    public function show_profile_students() {
        $current_user  = Sentinel::getUser()->email;
        $courses = CourseModel::all();
        $student = DB::table('student_info')
            ->select('alternate_id as student_id', 
                    'name as student_name', 
                    'course as student_course',
                    'year as student_year',
                    'contact_number as contact_number'
                    )
            ->where('email', $current_user);
        $skips = ["[","]","\""];
        $user = auth()->user()->studentInfo;
        $learner = auth()->user()->learner;

        $student_name = str_replace($skips, ' ',$student->pluck('student_name'));
        $student_course = str_replace($skips, ' ',$student->pluck('student_course'));
        $student_year = str_replace($skips, ' ',$student->pluck('student_year'));
        $contact_number = str_replace($skips, ' ',$student->pluck('contact_number'));
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        return view('students.profile.profile')->with('student_name', $student_name)
                                            ->with('student_course', $student_course)
                                            ->with('student_year', $student_year)
                                            ->with('contact_number', $contact_number)
                                            ->with('courses', $courses)
                                            ->with('batches', $batches)
                                            ->with('years', $years)
                                            ->with('user', $user)
                                            ->with('learner', $learner);
    }

      // function to update student profile
      public function update_profile(Request $request)
      {

          // $current_user_id = Sentinel::getUser()->id;
          // $sentinel_model = Sentinel::findById($current_user_id);
          // $sentinel_model->first_name = $request->input('full_name');
          // $sentinel_model->address = $request->input('address');
          // $sentinel_model->phone = $request->input('contact_number');

          // $email  = Sentinel::getUser()->email;
          // $student = DB::table('student_info')
          //   ->select('id as data_id')
          //   ->where('email', $email);
          // $skips = ["[","]","\""];
          // $id = str_replace($skips, ' ',$student->pluck('data_id'));
          // dd($id);
          // $student_info = StudentInfoModel::findOrfail($id);
          // $student_info->name = $request->input('full_name');
          // $student_info->course = $request->input('course');
          // $student_info->year = $request->input('year');
          // $student_info->contact_number = $request->input('contact_number');
          
          // $student_info->update();
          // $sentinel_model->update();
          $user = auth()->user();
          User::find($user->id)->update([
            'first_name'=>$request->input('full_name'),
            'address'=>$request->input('address'),
            'phone'=>$request->input('contact_number'),
          ]);
          $user->courses()->delete();
          
          foreach($request->courses as $key=>$course){
            $user->courses()->create([
              'course_id'=>$course
            ]);
          }
          $user->studentInfo->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'name' => "{$request->input('firstname')} {$request->input('lastname')}",
            'school_year' => $request->input('school_year'),
            'batch' => $request->input('batch'),
            'contact_number' => $request->input('contact_number'),
          ]);
          Session::flash('statuscode', 'info');
          return redirect('show_profile_students')->with('status', 'Data Updated Successfully!');
      }
}
