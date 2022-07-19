<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\StudentsDocumentsModel as StudentsDocumentsModel;
use Illuminate\Support\Carbon;
use DB;
use Faker\Documentor;
use Session;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;
use Sentinel;

class StudentDocumentController extends Controller
{
    // show documents page
    public function show_documents_students() {
        $studentdocuments = StudentsDocumentsModel::all();
        return view('students.documents.documents')->with('studentdocuments', $studentdocuments);
    }

    // add a document
    public function add_document_students(Request $request) {
        $current_user = Sentinel::getUser()->first_name;
        // upload file
        $dt = Carbon::now();
        $folder_name= 'students_upload';
        $file_description = $request->file_description;
        $date_time = $dt->toDayDateTimeString();
        \Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('fileupload')) {
            foreach ($request->fileupload as $touploadfile) {
                $destinationPath = $folder_name.'/';
                $file_name = $touploadfile->getClientOriginalName(); //Get file original name                   
                $file_size = $touploadfile->getSize(); //Get file original Size                
                $upload_file = [
                    'file_name'=>$file_name,
                    'path'=> $destinationPath.$file_name,
                    'description'=> $file_description,
                    'size'=> $file_size,
                    'datetime'=>$date_time,
                    'submitted_by'=>$current_user,
                ];

                \Storage::disk('local')->put($folder_name.'/'.$file_name,file_get_contents($touploadfile->getRealPath()));
                DB::table('students_documents')->insert($upload_file);
            }
        }

        Session::flash('statuscode', 'success');
        return redirect('show_documents_students')->with('status', 'Data Added Successfully!');
    }

    //  show the page to edit the documents 
    public function show_edit_documents_students($id){
        $documents_students = StudentsDocumentsModel::findOrfail($id);
        return view('students.documents.edit_documents')->with('documents_students', $documents_students);
    }

    // function to update document
    public function edit_document_students(Request $request, $id)
    {
        $documents_students = StudentsDocumentsModel::findOrfail($id);
        $documents_students->description = $request->input('description');
        
        $documents_students->update();
        
        Session::flash('statuscode', 'info');
        return redirect('show_documents_students')->with('status', 'Data Updated Successfully!');
    }
}
