<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;      
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Notifications\AdminToStudentRequestNotification;
use App\Notifications\StudentToAdminRequestNotification;
use App\Models\PrimaryModels\RequestModel as RequestModel;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfoModel;

class RequestController extends Controller
{
    // show requests page
    public function show_requests() {
        $requests = RequestModel::whereHas('studentInfo', function($q){
            $q->whereNull('deleted_at');
        })->get();
        $role = Sentinel::findRoleBySlug('User');
        $users = $role->users()->with('roles')->get();
        $students = StudentInfoModel::all();
        return view('admin.requests.requests')->with('requests', $requests)
                                            ->with('users', $users)
                                            ->with('students', $students);
    }

    // show the page to respond the request
    public function show_respond_to_request($id){
        $requests = RequestModel::findOrfail($id);
        $students = StudentInfoModel::all();
        $role = Sentinel::findRoleBySlug('admin');
        $users = $role->users()->with('roles')->get();
        return view('admin.requests.respond_request')
                        ->with('users', $users)
                        ->with('requests', $requests)
                        ->with('students', $students);
    }

    // respond to request
    public function respond_to_request(Request $request, $id) {

        // upload file
        $requestModel = RequestModel::findOrFail($id);

        $dt = Carbon::now();
        $folder_name= 'responses/' . str_replace(" ","", $requestModel->student_id);
        $file_description = $request->file_description;
        $date_time = $dt->toDayDateTimeString();
        \Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('fileupload')) {
            foreach ($request->fileupload as $touploadfile) {
                $destinationPath = $folder_name.'/';
                $file_name = $touploadfile->getClientOriginalName(); //Get file original name                   
                $file_size = $touploadfile->getSize(); //Get file original Size                
                $upload_file = [
                    'student_id'=>$request->student_id,
                    'file_name'=>$file_name,
                    'path'=> $destinationPath.$file_name,
                    'request_date'=> $request->request_date,
                    'release_date'=> $request->release_date,
                    'processing_officer'=> $request->processing_officer,
                    'date_sent'=>$date_time,
                    'request_id'=>$id,
                ];

                \Storage::disk('local')->put($folder_name.'/'.$file_name,file_get_contents($touploadfile->getRealPath()));
                // DB::table('response_table')->insert($upload_file);
                $requestModel->update([
                    'is_responded' => true,
                    'processing_officer'=>$request->processing_officer_name,
                    'release_date'=>now(),
                    'status' => 'Sent',
                    'path' => $destinationPath.$file_name
                ]);

            }
        }

        $requests = RequestModel::findOrfail($id);
        $requests->is_responded = 1;
        $requests->save();
        User::find($requestModel->studentInfo->id)->notify(new StudentToAdminRequestNotification($requestModel, false));

        Session::flash('statuscode', 'success');
        return redirect('show_requests')->with('status', 'Request Respond Success!');
    }


    //  show the page to edit the request
    public function show_edit_request($id){
        $requests = RequestModel::findOrfail($id);
        $role = Sentinel::findRoleBySlug('Admin');
        $users = $role->users()->with('roles')->get();
        return view('admin.requests.edit_request')->with('requests', $requests)
                                            ->with('users', $users);
    }

    // function to update request
    public function edit_request(Request $request, $id)
    {
        $requests = RequestModel::findOrfail($id);    
        $requests->release_date = $request->input('release_date');
        $requests->processing_officer = $request->input('processing_officer');
        $requests->status = $request->input('status');

        $requests->update();
        Session::flash('statuscode', 'info');
        return redirect('show_requests')->with('status', 'Data Updated Successfully!');
    }

    public function delete_request(Request $request, $id){
        RequestModel::findOrFail($id)->delete();
        Session::flash('statuscode', 'info');

        return response()->json([], 200);
        return redirect('show_requests')->with('status', 'Request Deleted!');

    }

}
