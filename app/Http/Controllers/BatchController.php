<?php

namespace App\Http\Controllers;

use App\User;
use App\Batch;
use App\BatchCertificate;
use App\Rules\BatchUnique;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PrimaryModels\CourseModel;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        $courses = CourseModel::select('id','course_name')->orderBy('course_name','desc')->get();
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        $list = Batch::with('users','course','certificates')
            ->when($request->course_id, function($q, $value){
                $q->where('course_id', $value);
            })
            ->when($request->year, function($q, $value){
                $q->where('year', $value);
            })
            ->when($request->batch, function($q, $value){
                $q->where('batch', $value);
            })
            ->orderBy('name','desc')->get();

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
                'year'=>'required|gt:0',
                'certificate.*'=>'required|distinct'
            ],
            [
                'course_id.required' => 'Course is required',
                'name.required' => 'Name is required',
                'max_slot.required' => 'Max slot is required',
                'batch.required' => 'Batch is required',
                'year.required' => 'Year slot is required',
                'certificate.*.required'=>'Certificate is Required',
                'certificate.*.distinct'=>'Certificate is duplicate',
            ]
        );

        $batch = Batch::create([
            'course_id'=> $request->course_id,
            'name'=>$request->name,
            'max_slot'=>$request->max_slot,
            'batch'=>$request->batch,
            'year'=>$request->year
        ]);

        foreach($request->certificate as $name)
        {
           $batch->certificates()->create([
                'name'=> $name
           ]);
        }
        

        Session::flash('status','Success!');
        Session::flash('statuscode','Batch Created!');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);  
        $request->validate(
            [
                'name'=>'required|unique:batches,name,' . $id,
                'max_slot'=>'required|gte:0',
            ],
            [
                'name.required' => 'Name is required',
                'max_slot.required' => 'Max slot is required',
            ]
        );

        
        $batch->update([
            'name'=>$request->name,
            'max_slot'=>$request->max_slot
        ]);

        $retained_keys = [];
        if(!is_null($request->certificate)){
            foreach($request->certificate as $key=>$name)
            {
                if(!str_contains( $key, "existing-")){
                    $id = $batch->certificates()->create([
                        'name'=>$name
                    ])->id;
                    $retained_keys[] = $id;
                }else{
                    $arr = explode("-",$key);
                    $existing_key = $arr[count($arr)-1];
                    $retained_keys[] = $existing_key;
                    $batch->certificates()->find($existing_key)->update([
                        'name'=> $name
                    ]);
                }   
            }
            $batch->certificates()->whereNotIn('id', $retained_keys)->delete();
        }else{
            $batch->certificates()->delete();

        }
        Session::flash('status','Success!');
        Session::flash('statuscode','Batch Updated!');

        return redirect()->back();
    }
    public function showManage($id)
    {
        $batch = Batch::with('users.learner','course')->findOrFail($id);
        $toEnlist = User::with('learner')->whereHas('studentInfo')->whereNotIn('id', $batch->users->pluck('id')->toArray())->get();
        // $toEnlist = User::whereHas('studentInfo')->get();
        $batch_id = $id;
        return view('admin.batches.manage', compact('batch','toEnlist','batch_id'));
    }

    public function enlist(Request $request, $id)
    {
        $request->validate(
            [
                'user_ids.*'=>['required','exists:users,id']
            ]
        );
        $batch = Batch::findOrFail($id);
        $batch->users()->attach($request->user_ids, ['status'=>2]);
        
        if($batch->certificates()->count() > 0){
            foreach($request->user_ids  as $user_id)
            {
                foreach($batch->certificates as $certificate){
                    $to_add = $certificate->userCertificates()->where('user_id', $user_id)->count() == 0;
                    if($to_add){
                        $certificate->userCertificates()->create(['user_id'=>$user_id]);
                    }
                }
            }
        }
        return response()->json([], 200);
    }
    

    public function updateManage(Request $request, $id)
    {
        $request->validate(
            [
                'user_ids.*'=>['required','exists:users,id'],
                'status'=> ['required' , Rule::in([1,2,3,4])]
            ]
        );

        $message = "Statuses successfully updated";
        if($request->status == 4){
            $message = "Student successfully removed";
            $batch = Batch::findOrFail($id);
            $batch->users()->detach($request->user_ids);
            $batch_certificate_ids = $batch->certificates->pluck('id')->toArray();
            DB::table('batch_certificate_users')->whereIn('batch_certificate_id', $batch_certificate_ids)->whereIn('user_id', $request->user_ids)->delete();
        }else{
            DB::table('batch_users')->whereIn('user_id', $request->user_ids)->update(['status'=>$request->status,'updated_at'=>now()]);
            // Batch::findOrFail($id)->users()->whereIn('user_id', $request->user_ids)->update(['status'=>$request->status]);
        }
        
        return response()->json(['message'=>$message], 200);

    }
}
