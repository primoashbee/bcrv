<?php

namespace App\Http\Controllers;

use App\User;
use App\Requirement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\PrimaryModels\StudentInfo;
use App\Rules\RequirementExistRule;
use App\StudentRequirement;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RequirementController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        
        $is_admin = $user->roles->first()->name == "Admin" ? true : false;

        if($is_admin){
            $college = Requirement::college()->get();
            $high_school = Requirement::highSchool()->get();
            $college_undergrad = Requirement::undergrad()->get();
            $als = Requirement::als()->get();
            
            return view('admin.requirements.index',compact('college','high_school','college_undergrad','als'));
        }

        $user_id = $user->id;
        $level = StudentInfo::find($user_id)->education_level;

        $list  = Requirement::active()->where('education_level',$level)->get();
        $requirements = $list->pluck('id')->toArray();
        $existing     = User::find($user->id)->studentRequirements->pluck('requirement_id')->toArray();
        $to_add = array_merge(array_diff($requirements, $existing),array_diff($existing, $requirements));

        foreach($to_add as $requirement_id)
        {
            User::find($user->id)->studentRequirements()->create(
                [
                    'requirement_id'=>$requirement_id,
                    'status' => StudentRequirement::MISSING,
                ]);
        }

        $list = User::find($user->id)->studentRequirements;

        return view('students.requirements.index', compact('list','level','user_id'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>['required', new RequirementExistRule($request->education_level)],
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
