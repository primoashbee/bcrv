<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Rules\BatchUnique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PrimaryModels\CourseModel;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        $courses = CourseModel::select('id','course_name')->orderBy('course_name','desc')->get();
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        $list = Batch::with('users','course')->orderBy('id','desc')->get();
        return view('admin.batches.index', compact('list','courses','batches','years'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'course_id'=>'required|exists:courses,id',
                'name'=>'required|unique:batches,name',
                'max_slot'=>'required|gte:0',
                'batch'=>['required','gt:0', new BatchUnique($request->course_id, $request->year)],
                'year'=>'required|gt:0'
            ],
            [
                'course_id.required' => 'Course is required',
                'name.required' => 'Name is required',
                'max_slot.required' => 'Max slot is required',
                'batch.required' => 'Batch is required',
                'year.required' => 'Year slot is required',
            ]
        );

        Batch::create([
            'course_id'=> $request->course_id,
            'name'=>$request->name,
            'max_slot'=>$request->max_slot,
            'batch'=>$request->batch,
            'year'=>$request->year
        ]);

        Session::flash('status','Success!');
        Session::flash('statuscode','Batch Created!');

        return redirect()->back();
    }

    public function showManage($id)
    {
        $batch = Batch::with('users','course')->findOrFail($id);
        dd($batch);
    }
}
