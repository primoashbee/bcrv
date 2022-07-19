@extends('layouts.master')

@section('title')
    Admin | Dashboard
@endsection

@section('content')
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $student_count }}</h3>
            <p>Number of Students</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-stalker"></i>
          </div>
          <a href="/show_students" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $requests_count }}<sup style="font-size: 20px"></sup></h3>
            <p>Number of Requests</p>
          </div>
          <div class="icon">
            <i class="ion ion-speakerphone"></i>
          </div>
          <a href="/show_requests" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $pending_count }}</h3>
            <p>Number of Pending Requests</p>
          </div>
          <div class="icon">
            <i class="ion ion-clock"></i>
          </div>
          <a href="/show_requests" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $completed_count }}</h3>
            <p>Number of completed Requests</p>
          </div>
          <div class="icon">
            <i class="ion ion-checkmark"></i>
          </div>
          <a href="/show_requests" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <section class="col-lg-8 connectedSortable">
        <!-- Calendar -->
        <div class="card bg-gradient-danger">
          <div class="card-header border-0">
  
            <h3 class="card-title">
              <i class="far fa-calendar-alt"></i>
              Calendar
            </h3>
            <!-- tools card -->
            <div class="card-tools">
              <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pt-0">
            <!--The calendar -->
            <div id="calendar0" style="width: 100%"></div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>

      <div class="col-md-12 col-lg-7 col-xl-4">
        <div class="card mb-2">
          <img class="card-img-top" src="{{ asset('admin_assets/dist/img/gallery/4.avif') }}" alt="Dist Photo 3" style="height: 310px;">
          <div class="card-img-overlay">
            <h5 class="card-title text-success">Good day!</h5>
           <strong><p class="card-text pb-1 pt-1 text-white">
              Have <br>
              a <br>
              nice <br>
              day ahead! </p></strong> 
          </div>
        </div>
      </div>
    </div>
    
   
@endsection

@section('scripts')
<!-- jQuery -->
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin_assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('admin_assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin_assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin_assets/dist/js/pages/dashboard.js') }}"></script>


@endsection