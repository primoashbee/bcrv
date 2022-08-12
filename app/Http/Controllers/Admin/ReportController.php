<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\RequestModel as RequestModel;
use Session;

class ReportController extends Controller
{
    // show show_reports page
    public function show_reports() {
        dd('wtf');
        $requests = RequestModel::all();
        $countpending = RequestModel::where('status', 'pending')->count();
        $countongoing = RequestModel::where('status', 'ongoing')->count();
        $countreceived = RequestModel::where('status', 'received')->count();
        return view('admin.reports.reports')->with('requests', $requests)
                                        ->with('countpending', $countpending)
                                        ->with('countongoing', $countongoing)
                                        ->with('countreceived', $countreceived);
    }
}
