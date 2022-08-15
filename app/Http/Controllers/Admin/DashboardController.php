<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\RequestModel as RequestModel;
use App\Models\PrimaryModels\StudentInfo as StudentInfo;
use App\Models\PrimaryModels\ResponseModel as ResponseModel;
use Carbon\CarbonTimeZone;
use Illuminate\Support\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Sentinel;

class DashboardController extends Controller
{
    // function to not let guest users access the admin panel
    public function dashboard() {

        if(Sentinel::getUser()->roles->first()->name == 'Admin'){
            return redirect(url('/show_dashboard'));
        }else{
            return redirect(url('/show_dashboard_students'));
        }
    }

    // show dashboard page
    public function show_dashboard() {
        $student_count = StudentInfo::count();
        $requests_count = RequestModel::count();
        $requests_count = RequestModel::count();
        $pending_count = RequestModel::where('status', 'pending')->count();
        $completed_count = RequestModel::where('status', 'received')->count();
        $announcement = Announcement::pinned();

        return view('admin.dashboard.dashboard')->with('student_count', $student_count)
                                            ->with('requests_count', $requests_count)
                                            ->with('pending_count', $pending_count)
                                            ->with('completed_count', $completed_count)
                                            ->with('announcement', $announcement);
    }
     
    // function to get count of latest requests - for notification - admin
    public function newest_requests(){
        $requests = RequestModel::whereDate('created_at', Carbon::now())->count();
        return $requests;
    }

    // show notifications panel - admin
    public function show_notifications() {
        $requests = RequestModel::whereDate('created_at', Carbon::now())->get();
        return view('admin.notifications.notifications')->with('requests', $requests);
    }

    // ============================= Functions for - STUDENT ============================= //
    // show dashboard page for students
    public function show_dashboard_students() {
        $student_email = Sentinel::getUser()->email;
        $roles_student = 2;
        $announcement = Announcement::pinned();

        $request_students = DB::select(
            DB::raw("SELECT 
                    COUNT(CASE WHEN requests.status = 'pending' THEN requests.status END) as student_pending_count,
                    COUNT(CASE when requests.status = 'ongoing' THEN requests.status END) as student_ongoing_count,
                    COUNT(CASE when requests.status = 'received' THEN requests.status END) as student_received_count
                FROM requests
                JOIN student_info ON requests.student_id = student_info.alternate_id
                JOIN users ON student_info.email = users.email
                JOIN role_users ON users.id = role_users.user_id
                WHERE student_info.email = '$student_email'
                AND role_users.role_id = $roles_student
            ")
        );

        return view('students.dashboard.dashboard')->with('request_students', $request_students)->with('announcement', $announcement);
        
    }

    // function to get count of latest response - for notification - admin
    public function newest_response_students(){
        $current_user  = Sentinel::getUser()->email;    
        $student = DB::table('student_info')
            ->select('alternate_id as student_id')
            ->where('email', $current_user);
        $skips = ["[","]","\""];
        $student_id = str_replace($skips, '',$student->pluck('student_id'));
        $responses = ResponseModel::where('student_id', $student_id)
        ->orWhere('updated_at', Carbon::now())->count();
        return $responses;
    }

    // show notifications panel - admin
    public function show_response_students() {
        $current_user  = Sentinel::getUser()->email;    
        $student = DB::table('student_info')
            ->select('alternate_id as student_id')
            ->where('email', $current_user);
        $skips = ["[","]","\""];
        $student_id = str_replace($skips, '',$student->pluck('student_id'));
        $responses = ResponseModel::where('student_id', $student_id)
        ->orWhere('updated_at', Carbon::now())->get();
        return view('students.notifications.notifications')->with('responses', $responses);
    }

}
