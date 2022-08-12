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
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <!-- Calendar -->
        <div class="card bg-gradient-danger">
          <div class="card-header border-0">
  
            <h3 class="card-title" >
              <i class="fa fa-bullhorn"></i>
              Announcement
            </h3>
            <!-- tools card -->
            <div class="card-tools">
              <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              {{-- <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i> --}}
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <div class="card-body pt-0">
            <!--The calendar -->
            <div id="" style="width: 100%">
              <h4 > <i> {{$announcement->title }} </i></h4>
              <p class="pb-1 pt-1 "> {{$announcement->description }}</p>

              <p>{{$announcement->created_at->diffForHumans()}}</p>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>
    </div>
@endsection

@section('scripts')
 
@endsection