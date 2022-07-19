<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\RequeststoStudents as RequeststoStudents;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;
use Sentinel;
use Session;
use Illuminate\Support\Carbon;
use DB;

class RequesttoStudentsController extends Controller
{
    // show requests to students page
    public function show_requests_to_students() {
        $requests_toStudents = RequeststoStudents::all();
        $role = Sentinel::findRoleBySlug('User');
        $users = $role->users()->with('roles')->get();
        $students = StudentInfoModel::all();
        return view('admin.requests_to_students.requests_to_students')->with('requests_toStudents', $requests_toStudents)
                                                            ->with('users', $users)
                                                            ->with('students', $students);
    }

    // adding new request
    public function add_request_to(Request $request) {
        $dt = Carbon::now();
        $date_time = $dt->toDayDateTimeString();
        $requeststoStudents = new RequeststoStudents; 
        $role = Sentinel::findRoleBySlug('User');
        $users = $role->users()->with('roles')->get();
        $requested_student = $users->where('email', $request->student_email);
        
        $skips = ["[","]","\""];
        $requeststoStudents->student_id = str_replace($skips, ' ',$requested_student->pluck('id'));
        $requeststoStudents->request_from = Sentinel::getUser()->first_name;
        $requeststoStudents->document_name = $request->document_name;
        $requeststoStudents->date_of_request = $date_time;
        $requeststoStudents->message = $request->message;

        $requeststoStudents->save();
        Session::flash('statuscode', 'success');
        return redirect('show_requests_to_students')->with('status', 'Data Added Successfully!');
    }

    // download file
    public function download_response_from_student(Request $request, $file_name) {
        return response()->download(storage_path('app/upload/'.$file_name));
    }


    // STUDENTS 

    // show requests to students page
    public function show_requests_from_admins() {
        $requests_toStudents = RequeststoStudents::all();
        $current_user  = Sentinel::getUser();
        return view('students.student_response.student_response')->with('requests_toStudents', $requests_toStudents)
                                                            ->with('current_user', $current_user);
    }

    //  show the page to respond to the admin request
    public function respond_to_request_from_admin($id){
        $requests_toStudents = RequeststoStudents::findOrfail($id);
        return view('students.student_response.show_to_respond_student')->with('requests_toStudents', $requests_toStudents);
    }

    // respond to request
    public function respond_to_request_from_admins(Request $request, $id) {
        // upload file
        $folder_name= 'responses';
        \Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('fileupload')) {
            foreach ($request->fileupload as $touploadfile) {
                $destinationPath = $folder_name.'/';
                $file_name = $touploadfile->getClientOriginalName(); //Get file original name                   
                $file_size = $touploadfile->getSize(); //Get file original Size                
                $upload_file = [
                    'file_name'=>$file_name,
                    'path'=> $destinationPath.$file_name,
                    'status'=> 'finished',
                    'response_status'=> 'responded',
                ];

                \Storage::disk('local')->put($folder_name.'/'.$file_name,file_get_contents($touploadfile->getRealPath()));
                DB::table('request_to_students')->where('id', $id)->update($upload_file);
            }
        }

        Session::flash('statuscode', 'success');
        return redirect('show_requests_from_admins')->with('status', 'Request Respond Success!');
    }

}
