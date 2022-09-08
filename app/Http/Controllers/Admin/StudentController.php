<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use Session;

class StudentController extends Controller
{
    // show students page
    public function show_students() {
        $students = StudentInfoModel::with('user')->get();
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
        $courses = CourseModel::select('id','course_name')->orderBy('course_name','desc')->get();
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        return response()->json(compact('courses','batches','years'),200);
    }

}
