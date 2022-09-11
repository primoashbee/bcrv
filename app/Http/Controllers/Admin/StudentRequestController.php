<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\PrimaryModels\ResponseModel;
use App\Models\PrimaryModels\StudentsModel;
use App\Notifications\StudentToAdminRequestNotification;
use App\Models\PrimaryModels\RequestModel as RequestModel;
use App\Models\PrimaryModels\DocumentModel as DocumentModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;

class StudentRequestController extends Controller
{
    // show requests page - STUDENT
    public function show_requests_students() {
        // $student_info = StudentInfoModel::all();
        $requests = RequestModel::where('student_id', auth()->user()->studentInfo->alternate_id)->orderBy('id','desc')->get();
        $documents = DocumentModel::all();
        return view('students.requests.requests',compact('requests','documents'));
        // return view('students.requests.requests')->with('requests', $requests)
        //                             ->with('student_info', $student_info)
        //                             ->with('documents', $documents);
    }

    // adding new request
    public function add_request_students(Request $request) {
        

        $request_document = new RequestModel(); 
        $current_user  = Sentinel::getUser()->email;
        $student = DB::table('student_info')
            ->select('alternate_id as student_id', 'course as student_course')
            ->where('email', $current_user);
        $dt = Carbon::now();
        $date_time = $dt->toDayDateTimeString();    
        $skips = ["[","]","\""];

        $student_course = str_replace($skips, ' ',$student->pluck('student_course'));
        if($student_course == "") {
            $student_course = 'N/A';
        }else {
            $student_course = $student_course;
        }
        
        // $request_document->student_id = str_replace($skips, ' ',$student->pluck('student_id'));
        $request_document->student_id  = $student->first()->student_id;
        $request_document->course = $student_course;
        $request_document->document_name = $request->input('document_name');
        $request_document->number_of_copies = $request->input('number_of_copies');
        $request_document->date_of_request = $date_time;
        $request_document->status = 'Pending';

        $request_document->save();
        User::find(1)->notify(new StudentToAdminRequestNotification(($request_document)));
        Session::flash('statuscode', 'success');
        return redirect('show_requests_students')->with('status', 'Request Added Successfully!');
    }


    //  show the page to edit the request
     public function show_edit_request_students($id){
        $request_document = RequestModel::findOrfail($id);
        $documents = DocumentModel::all();
        return view('students.requests.edit_request')->with('request_document', $request_document)
                                                    ->with('documents', $documents);
    }

    // function to update course
    public function edit_request_students(Request $request, $id)
    {
        $request_document = RequestModel::findOrfail($id);
        $request_document->document_name = $request->input('document_name');
        $request_document->number_of_copies = $request->input('number_of_copies');
        
        $request_document->update();
        
        Session::flash('statuscode', 'info');
        return redirect('show_requests_students')->with('status', 'Data Updated Successfully!');
    }

    // receive request
    public function receive_request($id) {
        $requests = RequestModel::findOrfail($id);
        $response = ResponseModel::where('request_id', $requests->id)->first();

        if($response == null) {
            Session::flash('statuscode', 'error');
            return redirect('show_requests_students')->with('status', 'No response from the Admins yet!');
        }else {
            $requests->status = 'received';
            $response->status = 'received';
            $response->update();
            $requests->update();
            Session::flash('statuscode', 'success');
            return redirect('show_requests_students')->with('status', 'Received!');
        }
    }

    public function download($id){
        $request = RequestModel::findOrFail($id);
        $headers = array(
            'Content-Type: application/pdf',
          );
        $arr  =   explode('/',$request->path);
        $filename = $arr[count($arr)-1];
        return Storage::disk('local')->download($request->path);
            

    }

    public function view($id){
        $request = RequestModel::findOrFail($id);
        $headers = array(
            'Content-Type: application/pdf',
          );
          $arr  =   explode('/',$request->path);
          $filename = $arr[count($arr)-1];
    
          $path = Storage::disk('local')->path($request->path);
          return response()->file($path, $headers);
    }
}
