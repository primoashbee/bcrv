<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\DocumentModel as Documentmodel;
use Illuminate\Support\Carbon;
use DB;
use Faker\Documentor;
use Session;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
{
    // show documents page
    public function show_documents() {
        $documents = Documentmodel::all();
        return view('admin.documents.documents')->with('documents', $documents);
    }

    // add a document
    public function add_document(Request $request) {
        // upload file
        $dt = Carbon::now();
        $folder_name= 'upload';
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
                ];

                \Storage::disk('local')->put($folder_name.'/'.$file_name,file_get_contents($touploadfile->getRealPath()));
                DB::table('documents')->insert($upload_file);
            }
        }
        
        Session::flash('statuscode', 'success');
        return redirect('show_documents')->with('status', 'Data Added Successfully!');
    }

    //  show the page to edit the document
    public function show_edit_document($id){
        $documents = Documentmodel::findOrfail($id);
        return view('admin.documents.edit_documents')->with('documents', $documents);
    }

    // function to update document
    public function edit_document(Request $request, $id)
    {
        $documents = Documentmodel::findOrfail($id);    
        $documents->description = $request->input('file_description');

        $documents->update();
        Session::flash('statuscode', 'info');
        return redirect('show_documents')->with('status', 'Data Updated Successfully!');
    }

    // download file
    public function download_document(Request $request, $file_name) {
        return response()->download(storage_path('app/upload/'.$file_name));
    }

    // delete file
    public function delete_document($id) {
        $document = Documentmodel::findOrfail($id);    
        $document->delete();

        Session::flash('statuscode', 'error');
        return redirect('show_documents')->with('status', 'File Deleted!');
    }
}
