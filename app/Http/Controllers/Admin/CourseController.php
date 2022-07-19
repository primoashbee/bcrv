<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use Session;

class CourseController extends Controller
{
    // show courses page
    public function show_courses() {
        $courses = CourseModel::all();
        return view('admin.courses.courses')->with('courses', $courses);
    }

    // adding new course
    public function add_course(Request $request) {
        $courses = new CourseModel; 
        
        $courses->course_name = $request->input('course_name');
        $courses->course_description = $request->input('course_description');
        $courses->save();

        Session::flash('statuscode', 'success');
        return redirect('show_courses')->with('status', 'Data Added Successfully!');
    }

    //  show the page to edit the course
    public function show_edit_course_view($id){
        $courses = CourseModel::findOrfail($id);
        return view('admin.courses.edit_course')->with('courses', $courses);
    }

    // function to update course
    public function edit_course(Request $request, $id)
    {
        $courses = CourseModel::findOrfail($id);    
        $courses->course_name = $request->input('course_name');
        $courses->course_description = $request->input('course_description');

        $courses->update();
        Session::flash('statuscode', 'info');
        return redirect('show_courses')->with('status', 'Data Updated Successfully!');
    }

    // delete course
    public function delete_course($id) {
        $courses = CourseModel::findOrfail($id);    
        $courses->delete();

        Session::flash('statuscode', 'error');
        return redirect('show_courses')->with('status', 'Course Deleted!');
    }


}
