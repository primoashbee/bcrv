<?php

namespace App\Http\Controllers;

use App\BatchCertificate;
use Illuminate\Http\Request;
use App\BatchCertificateUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PrimaryModels\CourseModel;

class BatchCertificateController extends Controller
{
    public function index(Request $request)
    {
        $list = BatchCertificateUser::with('user.studentInfo','user.learner','certificate.batch.course')
            ->when($request->course_id,function($q, $value){
                $q->whereHas('certificate.batch', function($query) use ($value){
                    $query->where('course_id', $value);
                });
            })
            ->when($request->batch,function($q, $value){
                $q->whereHas('certificate.batch', function($query) use ($value){
                    $query->where('batch', $value);
                });
            })
            ->when($request->year,function($q, $value){
                $q->whereHas('certificate.batch', function($query) use ($value){
                    $query->where('year', $value);
                });
            })
            ->get();
        $courses = CourseModel::select('id','course_name')->orderBy('course_name','desc')->get();
        $batches = range(1,10);
        $years = range(now()->year, 2019);
        return view('admin.certificates.index',compact('list','courses','batches','years'));
    }

    public function update(Request $request, $id)
    {
        $certificate = BatchCertificateUser::with('certificate')->findOrFail($id);
        $file = $request->file('file');
        $ext  = $file->extension();
        // $requirement  = Requirement::find($key)->name;
        $student_info = $certificate->user->studentInfo;
        $cert_name = str_replace(" ","-", $certificate->certificate->name );
        $filename = "$student_info->email/$student_info->name - $cert_name.$ext";
        Storage::disk('certificates')->putFileAs(
            '',
            $file,
            $filename
        );
        
        $certificate->update(['path'=>$filename]);

        return response()->json([
            'message'=>'Upload Success'
        ],200);
    }

    public function view($id){
        $file = BatchCertificateUser::findOrFail($id);

        $headers = array(
            'Content-Type: application/pdf',
          );
    
        $path = Storage::disk('certificates')->path($file->path);
        return response()->file($path, $headers);
        
    }
    public function download($id){

        $file = BatchCertificateUser::findOrFail($id);
        return Storage::disk('certificates')->download($file->path);

    }


    public function myCertificates(Request $request)
    {
        $user_id = auth()->user()->id;
        

        //get the batch ids
        $batch_ids = DB::table('batch_users')
                            ->select('id','batch_id','user_id')
                            ->where('user_id', $user_id)
                            ->where('status', 1)
                            ->get();
        

        $certificates = BatchCertificateUser::with('certificate')
            ->whereHas('certificate.batch.course', function($q) use ($batch_ids) {
                $q->whereIn('batch_id', $batch_ids->pluck('batch_id')->toArray());
            })
            ->where('user_id', $user_id)
            ->whereNotNull('path')
            ->get();
        return view("students.certificates.index", compact("certificates"));
    }
}
