<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LearnerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->learner()->updateOrCreate([]);
        $profile = $user->learner;
        return view('learners.create',compact("profile"));
    }

    public function setup()
    {
        $profile = auth()->user()->learner;
        return response()->json(compact('profile'),200);
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        $request->validate([
            'barangay'=>'required',
            'birth_city'=>'required',
            'birth_province'=>'required',
            'birth_region'=>'required',
            'birthday'=>'required',
            'city'=>'required',
            'civil_status'=>'required',
            'classification'=>'required',
            'contact_number'=>'required',
            'course_qualification'=>'required',
            'date_received'=>'nullable',
            'disability_cause'=>'required',
            'disability_type'=>'required',
            'district'=>'required',
            'educational_attainment'=>'required',
            'email'=>'required|email',
            'employment_status'=>'required',
            'entry_date'=>'required',
            'firstname'=>'required',
            'gender'=>'required',
            'lastname'=>'required',
            'learner_id'=>'required|unique:learners,learner_id,' . $user->learner->id,
            'nationality'=>'required',
            'others_classification'=>'nullable',
            'parent_mailing_address'=>'required',
            'parent_name'=>'required',
            'province'=>'required',
            'region'=>'required',
            'scholarship_package'=>'required',
            'street'=>'required',
        ]);
        $user->learner()->update([
            'barangay'=> $request->barangay,
            'birth_city'=>$request->birth_city,
            'birth_province'=>$request->birth_province,
            'birth_region'=>$request->birth_region,
            'birthday'=>$request->birthday,
            'city'=>$request->city,
            'civil_status'=>$request->civil_status,
            'classification'=>$request->classification,
            'contact_number'=>$request->contact_number,
            'course_qualification'=>$request->course_qualification,
            'date_received'=> now(),
            'disability_cause'=>$request->disability_cause,
            'disability_type'=>$request->disability_type,
            'district'=>$request->district,
            'educational_attainment'=>$request->educational_attainment,
            'email'=> $request->email,
            'employment_status'=>$request->employment_status,
            'entry_date'=>$request->entry_date,
            'firstname'=>$request->firstname,
            'gender'=>$request->gender,
            'lastname'=>$request->lastname,
            'learner_id'=>$request->learner_id,
            'middlename'=>$request->middlename,
            'nationality'=>$request->nationality,
            'others_classification'=>$request->others_classification,
            'parent_mailing_address'=>$request->parent_mailing_address,
            'parent_name'=>$request->parent_name,
            'province'=>$request->province,
            'region'=>$request->region,
            'scholarship_package'=>$request->scholarship_package,
            'street'=>$request->street,
            'finished'=>true,
            'finished_at'=>now()
        ]);

        return response()->json(['message'=>'Learner Profile Updated!','finished'=>1],200);
    }
    public function view(Request $request, $id)
    {
        $file = Storage::disk('templates')->path('TESDA-LEARNERS-FORM.docx');
        $filename = 'Ashbee Morgado - Learners Profile.docx';
        //XXX-XX-XXX-XXXXX-XXX
        $learner_id = "0AX-DW-442-5KLJS-222";
        $template = new TemplateProcessor($file);
        $tab = "    ";

        $template->setValue('learner_id',$learner_id);
        $template->setValue('lastname','Morgado');
        $template->setValue('firstname','John Ashbee');
        $template->setValue('middlename','Allego');
        $template->setValue('street','1647 Balic-Balic');
        $template->setValue('barangay','Sta. Rita');
        $template->setValue('district','13');
        $template->setValue('city','Olongapo');
        $template->setValue('province','Zambales');
        $template->setValue('region','3');
        $template->setValue('email','ashbee.morgado@icloud.com');
        $template->setValue('contact_number','09685794313');
        $template->setValue('nationality','Filipino');


        $template->setValue('is_f','✓ Female');
        $template->setValue('is_m',"$tab Male");






        $template->setValue('birth_month','November');
        $template->setValue('birth_day','26');
        $template->setValue('birth_year','1994');
        $template->setValue('age','27');
        $template->setValue('birth_city','Olongapo');
        $template->setValue('birth_province','Olongapo');
        $template->setValue('birth_region','Olongapo');
        $template->setValue('parent_name','Arien Morgado');
        $template->setValue('parent_mailing_address','1647 Balic-Balic Sta. Rita Olongapo');

        $template->saveAs(Storage::disk('public')->path($filename));
        $path = Storage::disk('public')->path($filename);

     
        $headers = array(
            // 'Content-Type: application/pdf',
            'Content-Type: application/octet-stream',
            'Content-Disposition: attachment'
          );
        // dd($path, $headers);
        return Storage::disk('public')->download($filename);

        return response()->download($path, $headers);


        
    }
}
