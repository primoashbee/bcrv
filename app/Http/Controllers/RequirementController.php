<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\PrimaryModels\StudentInfo;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RequirementController extends Controller
{
    
    public function index()
    {
        $user = Sentinel::getUser();
        
        $is_admin = $user->roles->first()->name == "Admin" ? true : false;

        if($is_admin){
            $college = Requirement::college()->get();
            $high_school = Requirement::highSchool()->get();

            return view('admin.requirements.index',compact('college','high_school'));
        }

        $user_id = $user->id;
        $level = StudentInfo::find($user_id)->education_level;

        $list  = Requirement::where('education_level',$level)->get();

        // dd($list);


        return view('students.requirements.index', compact('list','level','user_id'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required',
                'education_level'=>['required',Rule::in(StudentInfo::EDUCATION_LEVEL)],
            ]
        );

        $mandatory  = $request->has('mandatory');
        $active  = $request->has('active');

        Requirement::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'education_level'=>$request->education_level,
            'mandatory'=>$mandatory,
            'active'=>$active
        ]);

        Session::flash('status','Success!');
        Session::flash('statuscode','Requirement Added!');

        return redirect()->back();

        
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required',
                'education_level'=>['required',Rule::in(StudentInfo::EDUCATION_LEVEL)],
            ]
        );
        $mandatory  = $request->has('mandatory');
        $active  = $request->has('active');
        Requirement::find($id)->update(
            [
                'name'=>$request->name,
                'description'=>$request->description,
                'education_level'=>$request->education_level,
                'mandatory'=>$mandatory,
                'active'=>$active    
            ]
            );
        Session::flash('status','Success!');
        Session::flash('statuscode','Requirement Updated!');

        return redirect()->back();
    }

    public function studentStore(Request $request)
    {
        dd($request->all());
    }
}
