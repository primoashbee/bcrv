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
        $students = StudentInfoModel::all();
        $courses = CourseModel::all();
        return view('admin.students.students')->with('students', $students)
                                            ->with('courses', $courses);
    }

    //  show the page to edit the students
    public function show_edit_student($id){
        $students = StudentInfoModel::findOrfail($id);
        $courses = CourseModel::all();
        return view('admin.students.edit_student')->with('students', $students)
                                                ->with('courses', $courses);
    }


    // function for the update students
    public function edit_student(Request $request, $id)
    {
        $students = StudentInfoModel::findOrfail($id);    
        $students->course = $request->input('course');
        $students->year = $request->input('year');
        $students->status = $request->input('status');

        $students->update();
        Session::flash('statuscode', 'info');
        return redirect('show_students')->with('status', 'Data Updated Successfully!');
    }

}
