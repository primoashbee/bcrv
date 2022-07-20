<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PrimaryModels\StudentInfo;

class RequirementController extends Controller
{
    
    public function index()
    {
        $list = ['Form 137', 'Birth Certificate', 'NBI Clearance'];
        return view('admin.requirements.index',compact('list'));
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

        
    }
}
