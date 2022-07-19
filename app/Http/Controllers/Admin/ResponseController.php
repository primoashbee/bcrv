<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\ResponseModel as ResponseModel;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Session;
class ResponseController extends Controller
{
    // show responses page
    public function show_responses() {

       

        $responses = ResponseModel::all();
        return view('admin.responses.responses')->with('responses', $responses);
    }

    // =============================== STUDENT =========================//
    // show responses page
     public function show_responses_students() {
        $current_user_id = Sentinel::getUser()->email;
        
        $student = DB::table('student_info')
            ->select('alternate_id as student_id')
            ->where('email', 'defaultstudent@gmail.com');
        $skips = ["[","]","\""];
        $responses = ResponseModel::all();
        $student_id = str_replace($skips, '',$student->pluck('student_id'));
        return view('students.responses.responses')->with('responses', $responses)
                                            ->with('student_id', $student_id);
    }

    // receive response
    public function receive_response($id) {
        $responses = ResponseModel::findOrfail($id);
        $responses->status = 'received';
        $responses->update();
        Session::flash('statuscode', 'success');
        return redirect('show_responses_students')->with('status', 'Responded Successfully!');
    }

    // download file
    public function download_document_students(Request $request, $file_name) {
        return response()->download(storage_path('app/upload/'.$file_name));
    }

}
