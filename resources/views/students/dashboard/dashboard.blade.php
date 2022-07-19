@extends('layouts.master_student')

@section('title')
  Student | Dashboard
@endsection

@section('content')
    <div class="row">

      <div class="col-12">
        <div class="callout callout-info">
            Showing the status of your requests
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Pending Requests</span>
            <span class="info-box-number">
              @foreach($request_students as $request_student)
                {{$request_student->student_pending_count}}
              @endforeach
            </span>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tasks"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Ongoing Requests</span>
            <span class="info-box-number">
              @foreach($request_students as $request_student)
                {{$request_student->student_ongoing_count}}
              @endforeach
            </span>
          </div>
        </div>
      </div>

      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clock"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Received Documents</span>
            <span class="info-box-number">
              @foreach($request_students as $request_student)
                {{$request_student->student_received_count}}
              @endforeach
            </span>
          </div>
        </div>
      </div>
    </div>
   
@endsection

@section('scripts')
 
@endsection