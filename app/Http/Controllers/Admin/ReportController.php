<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentsModel as StudentsModel;
use App\Models\PrimaryModels\CourseModel as CourseModel;
use App\Models\PrimaryModels\RequestModel as RequestModel;
use App\Models\PrimaryModels\StudentInfo;
use App\Report;
use Session;

class ReportController extends Controller
{
    // show show_reports page
    public function show_reports(Request $request) {
        
        $filter_year = now()->year;
        if($request->has('school_year')){
            $filter_year = $request->school_year;
        }
        $courses_report = Report::studentPerBatch($filter_year);
        $courses_report_year = Report::studentPerYear(now()->year);
        // dd($courses_report);
        // dd($courses_report);
        // $requests = RequestModel::all();
        $countpending = RequestModel::where('status', 'Pending')
                            ->when($request->has('batch'), function($q,$data) use($request){
                                $q->whereHas('studentInfo', function($sq) use ($request){
                                    $sq->where('batch', $request->batch);
                                });
                            })
                            ->when($request->has('course'), function($q,$data)  use($request){
                                $q->whereHas('studentInfo', function($sq) use ($request){
                                    $sq->where('course', $request->course);
                                });
                            })
                            ->when($request->has('school_year'), function($q,$data) use($request){
                                $q->whereHas('studentInfo', function($sq) use ($request){
                                    $sq->where('school_year', $request->school_year);
                                });
                            })
                            ->count();
        $countsent = RequestModel::where('status', 'Sent')
                            ->when($request->has('batch'), function($q,$data) use($request){
                                $q->whereHas('studentInfo', function($sq) use ($request){
                                    $sq->where('batch', $request->batch);
                                });
                            })
                            ->when($request->has('course'), function($q,$data)  use($request){
                                $q->whereHas('studentInfo', function($sq) use ($request){
                                    $sq->where('course', $request->course);
                                });
                            })
                            ->when($request->has('school_year'), function($q,$data) use($request){
                                $q->whereHas('studentInfo', function($sq) use ($request){
                                    $sq->where('school_year', $request->school_year);
                                });
                            })
                            ->count();
        // $countongoing = RequestModel::where('status', 'ongoing')
        //                     ->when($request->has('batch'), function($q,$data){
        //                         $q->whereHas('studentInfo', function($sq) use ($data){
        //                             $sq->where('batch', $data);
        //                         });
        //                     })
        //                     ->when($request->has('course'), function($q,$data){
        //                         $q->whereHas('studentInfo', function($sq) use ($data){
        //                             $sq->where('course', $data);
        //                         });
        //                     })
        //                     ->when($request->has('school_year'), function($q,$data){
        //                         $q->whereHas('studentInfo', function($sq) use ($data){
        //                             $sq->where('school_year', $data);
        //                         });
        //                     })
        //               
        // $countsent = RequestModel::where('status', 'sent')
        // ->when($request->has('batch'), function($q,$data){
        //     $q->orWhereHas('studentInfo', function($sq) use ($data){
        //         $sq->where('batch', $data);
        //     });
        // })
        // ->when($request->has('course'), function($q,$data){
        //     $q->orWhereHas('studentInfo', function($sq) use ($data){
        //         $sq->where('course', $data);
        //     });
        // })
        // ->when($request->has('school_year'), function($q,$data){
        //     $q->orWhereHas('studentInfo', function($sq) use ($data){
        //         $sq->where('school_year', $data);
        //     });
        // })
        // ->count();      

        // $countsent = RequestModel::where('status', 'sent')
        //                     ->when($request->has('batch'), function($q,$data){
        //                         $q->whereHas('studentInfo', function($sq) use ($data){
        //                             $sq->where('batch', $data);
        //                         });
        //                     })
        //                     ->when($request->has('course'), function($q,$data){
        //                         $q->whereHas('studentInfo', function($sq) use ($data){
        //                             $sq->where('course', $data);
        //                         });
        //                     })
        //                     ->when($request->has('school_year'), function($q,$data){
        //                         $q->whereHas('studentInfo', function($sq) use ($data){
        //                             $sq->where('school_year', $data);
        //                         });
        //                     })
        //                     ->count();
        // $countongoing = RequestModel::where('status', 'ongoing')->count();
        // $countreceived = RequestModel::where('status', 'received')->count();

        $courses = CourseModel::select('id','course_name')->orderBy('course_name','asc')->get();
        $batches = StudentInfo::whereNotNull('batch')->distinct()->orderBy('batch','desc')->get(['batch']);
        // $batches = StudentInfo::whereNotNull('batch')->distinct()->get(['batch']);
        // $school_year = StudentInfo::whereNotNull('school_year')->distinct()->get(['id','school_year']);
        $school_year = StudentInfo::whereNotNull('school_year')->distinct()->orderBy('school_year','desc')->get(['school_year']);
        if($request->has('status')){
            if($request->status == 'sent'){
                $countpending = 0;
            }
            if($request->status == 'pending'){
                $countsent = 0;
            }
        }
        $batch_count = range(1,10);
        return view('admin.reports.reports')
                                        ->with('countpending', $countpending)
                                        // ->with('countongoing', $countongoing)
                                        ->with('countsent', $countsent)
                                        ->with('courses', $courses)
                                        ->with('batches', $batches)
                                        ->with('school_year', $school_year)
                                        ->with('batch_count', $batch_count)
                                        ->with('courses_report_year', $courses_report_year)
                                        ->with('courses_report', $courses_report);
    }
}
