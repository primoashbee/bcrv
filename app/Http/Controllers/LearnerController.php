<?php

namespace App\Http\Controllers;

use App\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LearnerController extends Controller
{
    protected $_rels;
    protected $_types;
    public function index(Request $request)
    {
        if($request->has('id')){
            if(auth()->user()->roles->first()->name =="Admin"){
                $user = User::find($request->id);
                $user->learner()->updateOrCreate([]);
                $profile = $user->learner->append('photo_preview_path');
                return view('learners.create',compact("profile"));
            }

            return abort(403);

        }
        $user = auth()->user();
        $user->learner()->updateOrCreate([]);
        $profile = $user->learner->append('photo_preview_path');
        return view('learners.create',compact("profile"));
    }

    public function setup(Request $request)
    {
        if($request->has('id')){
            if(auth()->user()->roles->first()->name =="Admin"){
                $user = User::find($request->id);
                $user->learner()->updateOrCreate([]);
                $profile = $user->learner;
                return response()->json(compact('profile'),200);
            }

            return abort(403);

        }
        $profile = auth()->user()->learner;
        return response()->json(compact('profile'),200);
    }

    public function update(Request $request)
    {

        $user = auth()->user();
        $request->request->remove('signature');
        // $rules = [
        //     'barangay'=>'required',
        //     'birth_city'=>'required',
        //     'birth_province'=>'required',
        //     'birth_region'=>'required',
        //     'birthday'=>'required',
        //     'city'=>'required',
        //     'civil_status'=>'required',
        //     'classification'=>'required',
        //     'contact_number'=>'required',
        //     'course_qualification'=>'required',
        //     'date_received'=>'nullable',
        //     'disability_cause'=>'required',
        //     'disability_type'=>'required',
        //     'district'=>'required',
        //     'educational_attainment'=>'required',
        //     'email'=>'required|email',
        //     'employment_status'=>'required',
        //     'entry_date'=>'required',
        //     'firstname'=>'required',
        //     'gender'=>'required',
        //     'lastname'=>'required',
        //     'learner_id'=>'required|unique:learners,learner_id,' . $user->learner->id,
        //     'nationality'=>'required',
        //     'others_classification'=>'nullable',
        //     'parent_mailing_address'=>'required',
        //     'parent_name'=>'required',
        //     'province'=>'required',
        //     'region'=>'required',
        //     'scholarship_package'=>'required',
        //     'street'=>'required',
        //     'photo'=>'required|mimes: jpeg,jpg,png,bmp,webp',
        //     'signature'=>'nullable|mimes: jpeg,jpg,png,bmp,webp'
        // ];

        $rules = $this->rules($user);

        $has_photo = false;
        
        if($user->learner->finished){
            $rules['photo'] = 'nullable|mimes: jpeg,jpg,png,bmp,webp';
            $has_photo = true;
        }

        $request->validate($rules);

        $student_info = $user->studentInfo;
        $photo_filename = $user->learner->photo_path;

        if($request->has('photo')){
            $photo_file = $request->file('photo');
            $photo_ext  = $photo_file->extension();
            $photo_filename = "$student_info->email/$student_info->name - Photo.$photo_ext";
        }
        $signature_filename = $user->learner->signature_path;
        if($request->has('signature')){
            $signature_file = $request->file('signature');
            $signature_ext  = $photo_file->extension();
            $signature_filename  = "$student_info->email/$student_info->name - Signature.$photo_ext";

        }

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
            'finished_at'=>now(),
            'photo_path'=> $photo_filename,
            'signature_path'=> $signature_filename,
        ]);

        $user->update([
            'profile_setup_finished'=> true
        ]); 

        
        if($request->has('photo')){
            $res = Storage::disk('photos')->putFileAs(
                '',
                $photo_file,
                $photo_filename
            );
        }
        if($request->has('signature')){
            Storage::disk('signatures')->putFileAs(
                '',
                $signature_file,
                $signature_filename
            );
        }

        return response()->json(['message'=>'Learner Profile Updated!','finished'=>1],200);
    }
    public function updateFromAdmin(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $request->request->remove('signature');
        $rules = $this->rules($user);
        // $rules = [
        //     'barangay'=>'required|min:1|max:20',
        //     'birth_city'=>'required',
        //     'birth_province'=>'required',
        //     'birth_region'=>'required',
        //     'birthday'=>'required',
        //     'city'=>'required|min:1|max:50',
        //     'civil_status'=>'required',
        //     'classification'=>'required',
        //     'contact_number'=>'required|min:1|max:11',
        //     'course_qualification'=>'required|min:1|max:100',
        //     'date_received'=>'nullable',
        //     'disability_cause'=>'required',
        //     'disability_type'=>'required',
        //     'district'=>'required|min:1|max:20',
        //     'educational_attainment'=>'required',
        //     'email'=>'required|email',
        //     'employment_status'=>'required',
        //     'entry_date'=>'required',
        //     'firstname'=>'required',
        //     'gender'=>'required',
        //     'lastname'=>'required',
        //     'learner_id'=>'required|unique:learners,learner_id,' . $user->learner->id,
        //     'middlename'=>'nullable|min:1|max:20',
        //     'nationality'=>'required|min:1|max:20',
        //     'others_classification'=>'nullable',
        //     'parent_mailing_address'=>'required|min:1|max:20',
        //     'parent_name'=>'required|min:1|max:20',
        //     'province'=>'required|min:1|max:50',
        //     'region'=>'required|min:1|max:50',
        //     'scholarship_package'=>'required|min:1|max:100',
        //     'street'=>'required|min:1|max:50',
        //     'photo'=>'required|mimes: jpeg,jpg,png,bmp,web',
        //     'signature'=>'nullable|mimes: jpeg,jpg,png,bmp,web'
        // ];

        $has_photo = false;
        
        if($user->learner->finished){
            $rules['photo'] = 'nullable|mimes: jpeg,jpg,png,bmp,web';
            $has_photo = true;
        }

        $request->validate($rules);

        $student_info = $user->studentInfo;
        $photo_filename = $user->learner->photo_path;

        if($request->has('photo')){
            $photo_file = $request->file('photo');
            $photo_ext  = $photo_file->extension();
            $photo_filename = "$student_info->email/$student_info->name - Photo.$photo_ext";
        }
        $signature_filename = $user->learner->signature_path;
        if($request->has('signature')){
            $signature_file = $request->file('signature');
            $signature_ext  = $photo_file->extension();
            $signature_filename  = "$student_info->email/$student_info->name - Signature.$photo_ext";

        }

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
            'finished_at'=>now(),
            'photo_path'=> $photo_filename,
            'signature_path'=> $signature_filename,
        ]);

        $user->update([
            'profile_setup_finished'=> true
        ]); 

        
        if($request->has('photo')){
            $res = Storage::disk('photos')->putFileAs(
                '',
                $photo_file,
                $photo_filename
            );
            Log::info($res);
        }
        if($request->has('signature')){
            Storage::disk('signatures')->putFileAs(
                '',
                $signature_file,
                $signature_filename
            );
        }

        return response()->json(['message'=>'Learner Profile Updated!','finished'=>1],200);
    }
    public function view(Request $request, $id)
    {

        $this->_countRels=100; 

        $file = Storage::disk('templates')->path('TESDA-LEARNERS-FORM.docx');
        //XXX-XX-XXX-XXXXX-XXX
        $learner_id = "0AX-DW-442-5KLJS-222";
        $template = new TemplateProcessor($file);
        $tab = "    ";
        $profile = User::with('learner')->find($id)->learner;
        $name = $profile->firstname. " " . $profile->lastname;
        $filename = "$name - Learners Profile.docx";
        $template->setValue('learner_id',$profile->learner_id);
        $template->setValue('e_date', $profile->entry_date);
        $template->setValue('lastname', $profile->lastname);
        $template->setValue('firstname',$profile->firstname);
        $template->setValue('middlename',$profile->middlename);
        $template->setValue('fullname',$profile->fullname);
        $template->setValue('street',$profile->street);
        $template->setValue('barangay',$profile->barangay);
        $template->setValue('district',$profile->district);
        $template->setValue('city',$profile->city);
        $template->setValue('province',$profile->province);
        $template->setValue('region',$profile->region);
        $template->setValue('email',$profile->email);
        $template->setValue('contact_number',$profile->contact_number);
        $template->setValue('nationality',$profile->nationality);


        $template->setImageValue("profile_picture", [
            'path'=>public_path('/images/photos/' . $profile->photo_path), 
            'width'=>150, 
            'height'=>150,
            'ratio'=>true
        ]);
        $template->setImageValue("signature",  public_path('/images/signature.png'));

        //For Gender
        if($profile->gender == "Male"){
            $template->setValue('s1','✓');
            $template->setValue('s2', '');
        }else{
            $template->setValue('s2','✓');
            $template->setValue('s1', '');
        }

        //For Civil Status

        if($profile->civil_status == "Single"){
            $template->setValue('cs1','✓');
            $template->setValue('cs2', '');
            $template->setValue('cs3', '');
            $template->setValue('cs4', '');
            $template->setValue('cs5', '');
        }
        if($profile->civil_status == "Married"){
            $template->setValue('cs1','');
            $template->setValue('cs2', '✓');
            $template->setValue('cs3', '');
            $template->setValue('cs4', '');
            $template->setValue('cs5', '');
        }
    
        if($profile->civil_status == "Widowed"){
            $template->setValue('cs1','');
            $template->setValue('cs2', '');
            $template->setValue('cs3', '✓');
            $template->setValue('cs4', '');
            $template->setValue('cs5', '');
        }
        if($profile->civil_status == "Separated"){
            $template->setValue('cs1','');
            $template->setValue('cs2', '');
            $template->setValue('cs3', '');
            $template->setValue('cs4', '✓');
            $template->setValue('cs5', '');
        }
        if($profile->civil_status == "Solo Parent"){
            $template->setValue('cs1','');
            $template->setValue('cs2', '');
            $template->setValue('cs3', '');
            $template->setValue('cs4', '');
            $template->setValue('cs5', '✓');
        }
        
        //For Employement Status
        if($profile->employment_status == "Employed"){
            $template->setValue('es1','✓');
            $template->setValue('es2', '');
        }else{
            $template->setValue('es1','');
            $template->setValue('es2', '✓');  
        }

        //Educational Attainment
        if($profile->educational_attainment == "No Grade Completed"){
            $template->setValue("ea1",'✓');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Pre-school (Nursery/KinderPrep)"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'✓');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "High School Undergraduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'✓');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "High School graduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'✓');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Elementary Undergraduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'✓');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Post Secondary Undergraduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'✓');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "College Undergraduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'✓');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "College graduate or higher"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'✓');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Elementary Graduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'✓');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Post Secondary Graduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'✓');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Junior High Graduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'✓');
            $template->setValue("ea12",'');
        }
        if($profile->educational_attainment == "Senior High Graduate"){
            $template->setValue("ea1",'');
            $template->setValue("ea2",'');
            $template->setValue("ea3",'');
            $template->setValue("ea4",'');
            $template->setValue("ea5",'');
            $template->setValue("ea6",'');
            $template->setValue("ea7",'');
            $template->setValue("ea8",'');
            $template->setValue("ea9",'');
            $template->setValue("ea10",'');
            $template->setValue("ea11",'');
            $template->setValue("ea12",'✓');
        }

        //Classification
        if($profile->classification == "4PS Beneficiary"){
            $template->setValue("t1",'✓');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Agrarian Reform Beneficiary"){
            $template->setValue("t1",'');
            $template->setValue("t2",'✓');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Balik Probinsya"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'✓');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Displaced Workers"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'✓');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Drug Dependents Surrenderers/Surrenderees"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'✓');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Family Members of AFP and PNP Killed in Action"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'✓');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Family Members of AFP and PNP Wounded in Action"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'✓');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Farmers and Fishermen"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'✓');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Indigenous People & Cultural Communities"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'✓');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Industry Workers"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'✓');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Inmates and Detainees"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'✓');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }

        if($profile->classification == "MILF Beneficiary"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'✓');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Out-of-School-Youth"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'✓');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Overseas Filipino Workers (OFW) Dependents"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'✓');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "RCEF-RESP"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'✓');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Rebel Returnees/Decommissioned"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'✓');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Returning/Repatriated Overseas Filipino Workers (OFW)"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'✓');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Student"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'✓');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "TESDA Alumni"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'✓');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "TVET Trainees"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'✓');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Uniformed Personnel"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'✓');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Victim of Natural Disasters and Calamities"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'✓');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }
        if($profile->classification == "Wounded in Action AFP and PNP Personnel"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'✓');
            $template->setValue("t23",'');
            $template->setValue("t24",'');
        }

        $template->setValue("t_others",'');

        if($profile->classification == "Others"){
            $template->setValue("t1",'');
            $template->setValue("t2",'');
            $template->setValue("t3",'');
            $template->setValue("t4",'');
            $template->setValue("t5",'');
            $template->setValue("t6",'');
            $template->setValue("t7",'');
            $template->setValue("t8",'');
            $template->setValue("t9",'');
            $template->setValue("t10",'');
            $template->setValue("t11",'');
            $template->setValue("t12",'');
            $template->setValue("t13",'');
            $template->setValue("t14",'');
            $template->setValue("t15",'');
            $template->setValue("t16",'');
            $template->setValue("t17",'');
            $template->setValue("t18",'');
            $template->setValue("t19",'');
            $template->setValue("t19",'');
            $template->setValue("t20",'');
            $template->setValue("t21",'');
            $template->setValue("t22",'');
            $template->setValue("t23",'');
            $template->setValue("t24",'✓');
            $template->setValue("t_others",$profile->others_classification);
        }


        //Disability
        if($profile->disability_type =="Mental/intellectual"){
            $template->setValue("d1",'✓');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Visual Disability"){
            $template->setValue("d1",'');
            $template->setValue("d2",'✓');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Orthopedic (Musculoskeletal) Disability"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'✓');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Hearing Disability"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'✓');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Speech Impairment"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'✓');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Multiple Disabilities, specify"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'✓');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Psychosocial Disability"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'✓');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }
        if($profile->disability_type =="Disability Due to Chronic Illness"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'✓');
            $template->setValue("d9",'');
        }

        if($profile->disability_type =="Learning Disability"){
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'✓');
        }
        else{
            $template->setValue("d1",'');
            $template->setValue("d2",'');
            $template->setValue("d3",'');
            $template->setValue("d4",'');
            $template->setValue("d5",'');
            $template->setValue("d6",'');
            $template->setValue("d7",'');
            $template->setValue("d8",'');
            $template->setValue("d9",'');
        }


        //Cause of disability
        if($profile->disability_cause =="Congenital/Inborn"){
            $template->setValue("p1",'✓');
            $template->setValue("p2",'');
            $template->setValue("p3",'');
        }
        if($profile->disability_cause =="Illness"){
            $template->setValue("p1",'');
            $template->setValue("p2",'✓');
            $template->setValue("p3",'');
        }
        if($profile->disability_cause =="Injury"){
            $template->setValue("p1",'');
            $template->setValue("p2",'');
            $template->setValue("p3",'✓');
        }else{
            $template->setValue("p1",'');
            $template->setValue("p2",'');
            $template->setValue("p3",'');
        }


        //Course qualification
        $template->setValue("course_qualification",$profile->course_qualification);

        $template->setValue("scholarship_package",$profile->scholarship_package);

        
    






        $template->setValue('birth_month',Carbon::parse($profile->birthday)->format('F'));
        $template->setValue('birth_day',Carbon::parse($profile->birthday)->format('d'));
        $template->setValue('birth_year',Carbon::parse($profile->birthday)->format('Y'));
        $template->setValue('age',Carbon::parse($profile->birthday)->age);
        $template->setValue('birth_city',$profile->birth_city);
        $template->setValue('birth_province',$profile->birth_province);
        $template->setValue('birth_region',$profile->birth_region);
        $template->setValue('parent_name',$profile->parent_name);
        $template->setValue('parent_mailing_address',$profile->parent_mailing_address);

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


    public function guard()
    {
        $user = auth()->user();

        return view('students.guard-form');



    }

    public function rules(User $user)
    {
        return [
            'barangay'=>'required|min:1|max:50',
            'birth_city'=>'required|min:1|max:20',
            'birth_province'=>'required|min:1|max:20',
            'birth_region'=>'required',
            'birthday'=>'required',
            'city'=>'required|min:1|max:50',
            'civil_status'=>'required',
            'classification'=>'required',
            'contact_number'=>'required|min:1|max:11',
            'course_qualification'=>'required|min:1|max:100',
            'date_received'=>'nullable',
            'disability_cause'=>'required',
            'disability_type'=>'required',
            'district'=>'required|min:1|max:50',
            'educational_attainment'=>'required',
            'email'=>'required|email',
            'employment_status'=>'required',
            'entry_date'=>'required',
            'firstname'=>'required|min:1|max:50',
            'gender'=>'required|min:1|max:20|',
            'lastname'=>'required|min:1|max:50',
            'learner_id'=>'required|min:1|max:20|unique:learners,learner_id,' . $user->learner->id,
            'middlename'=>'nullable|min:1|max:50',
            'nationality'=>'required|min:1|max:20',
            'others_classification'=>'nullable',
            'parent_mailing_address'=>'required|min:1|max:50',
            'parent_name'=>'required|min:1|max:20',
            'province'=>'required|min:1|max:50',
            'region'=>'required|min:1|max:50',
            'scholarship_package'=>'required|min:1|max:100',
            'street'=>'required|min:1|max:50',
            'photo'=>'required|mimes: jpeg,jpg,png,bmp,web',
            'signature'=>'nullable|mimes: jpeg,jpg,png,bmp,web'
        ];
    }
}
