<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BCRV | @yield('title')</title>
  <link rel="icon" href="{{ asset('admin_assets/dist/img/icon.ico') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/bs-stepper/css/bs-stepper.min.css') }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/dropzone/min/dropzone.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper" id="app">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('admin_assets/dist/img/bcrv.png') }}" height="80" width="100">
    <p class="text-sm text-orange">BCRV Tech-Voc, Inc.</p>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="push-menu-hamburger"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <notification user_id="{{auth()->user()->id}}" is_admin="{{true}}"></notification>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('show_dashboard')}}" class="brand-link">
      <img src="{{ asset('admin_assets/dist/img/bcrv.png') }}" class="brand-image img-circle elevation-10" >
      <span class="brand-text font-weight-light">BCRV </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Sentinel:: check())
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="{{ asset('admin_assets/dist/img/admin.jpg') }}" class="nav-icon img-circle elevation-2" alt="User Image">
                <p class="text-sm">
                  {{ 'Administrator' }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ml-3" >
                <li class="nav-item">
                  <a href="/help" class="nav-link" >
                    <i class="fas fa-question-circle nav-icon"></i>
                    <p>Help</p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>Logout</p>
                  </a>
                  <form action="{{ url('/logout') }}" method="POST" id="logout-form" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @endif
          
          <li class="nav-item">
            <a href="{{ url('/show_dashboard') }}" class="nav-link {{ 'show_dashboard' == request()->path() ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('announcement.index') }}" class="nav-link {{ 'announcement' == request()->path() ? 'active' : '' }}">
              <i class="fa fa-bullhorn nav-icon"></i>
              <p>Announcement</p>
            </a>
          </li>

          <li class="nav-item">
            {{-- <a href="{{ route('requirements') }}" class="nav-link {{ 'requirements' == request()->path() ? 'active' : '' }}"> --}}
            <a href="#" class="nav-link">
              <i class="fa fa-list nav-icon"></i>
              <p>Requirements</p>
              <i class="right fas fa-angle-left"></i>

            </a>
            <ul class="nav nav-treeview ml-3" >
              <li class="nav-item">
                <a href="{{route('requirements')}}" class="nav-link" >
                  <i class="fas fa-list nav-icon"></i>
                  <p>List of Requirements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('requirements.uploaded')}}" class="nav-link" >
                  <i class="fas fa-upload nav-icon"></i>
                  <p>Uploaded Requirements</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ url('/show_courses') }}" class="nav-link {{ 'show_courses' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-book-open nav-icon"></i>
              <p>Courses</p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{ url('/show_students') }}" class="nav-link {{ 'show_students' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-users nav-icon"></i>
              <p>Students</p>
            </a>
          </li>

          <li class="nav-item">
            {{-- <a href="{{ url('/show_students') }}" class="nav-link {{ 'show_students' == request()->path() ? 'active' : '' }}"> --}}
              <a href="#" class="nav-link" >
              <i class="fas fa-book-open nav-icon"></i>
              <p>Courses</p>
              <i class="right fas fa-angle-left"></i>

            </a>
            <ul class="nav nav-treeview ml-3" >
              <li class="nav-item">
                <a href="/show_courses" class="nav-link" >
                  <i class="fas fa-list nav-icon"></i>
                  <p> Course/Qual. Offering</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/batches" class="nav-link" >
                  <i class="fas fa-layer-group nav-icon"></i>
                  <p> Course Batches</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            {{-- <a href="{{ url('/show_documents') }}" class="nav-link {{ 'show_documents' == request()->path() ? 'active' : '' }}"> --}}
            <a href="#" class="nav-link {{ 'show_documents' == request()->path() ? 'active' : '' }}" >

              <i class="fas fa-file nav-icon"></i>
              <p>Documents</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview ml-3" >
              <li class="nav-item">
                <a href="/show_documents" class="nav-link" >
                  <i class="fas fa-list nav-icon"></i>
                  <p> Documents for Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/issued_certificates" class="nav-link" >
                  <i class="fas fa-stamp nav-icon"></i>
                  <p> Issuance of Certificates </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-box nav-icon"></i>
              <p>Requests</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="/show_requests" class="nav-link" >
                  <i class="fas fa-outdent nav-icon"></i>
                  <p> Request from Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/show_requests_to_students" class="nav-link" >
                  <i class="fas fa-indent nav-icon"></i>
                  <p> Request to Students</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ url('/show_requests') }}" class="nav-link {{ 'show_requests' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-box nav-icon"></i>
              <p>Requests</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ url('/show_reports') }}" class="nav-link {{ 'show_reports' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-chart-line nav-icon"></i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/show_users') }}" class="nav-link {{ 'show_users' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-user nav-icon"></i>
              <p>Users</p>
            </a>
          </li>



          {{-- <li class="nav-item">
            <a href="{{ url('/show_responses') }}" class="nav-link {{ 'show_responses' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-inbox nav-icon"></i>
              <p>Responses</p>
            </a>
          </li> --}}

          {{-- <li class="nav-item">
            <a href="{{ url('/show_requests_to_students') }}" class="nav-link {{ 'show_requests_to_students' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-box nav-icon"></i>
              <p>Requests to Students</p>
            </a>
          </li>
           --}}
        </ul>
        
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid col-12" >
        @yield('content')
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<script src="{{ asset('js/app.js') . "?v=" .rand(0,200) }}" defer></script>
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
{{-- <script src="{{ asset('admin_assets/dist/js/adminlte.js') }}"></script> --}}

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('admin_assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<!-- for the sweet alert -->
{{-- <script src="{{ url('admin_assets/js/sweetalert.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
{{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

@if(request()->path() == "dashboard")
<script src="{{ asset('admin_assets/dist/js/pages/dashboard2.js') }}"></script>
@endif


<script defer>
  @if (session('status'))
  // swal({
  //   title: '{{ session('status') }}',
  //   icon: '{{ session('statuscode') }}',
  //   button: "Ok",
  // }).then(()=>{
  //   alert('deleted')
  // })
    Swal.fire(
        '{{ session('status') }}',
        '{{ session('statuscode') }}',
        'success'
    )
  @endif
</script>

{{-- count --}}
<script>
  // $(setInterval(function(){
  //   $.ajax({
  //       url: "/newest_requests",
  //       success: function( response ) {
  //           $('#newest_requests').text( response );
  //       }
  //   });
  // },1000));
</script>
@yield('scripts')
</body>
</html>
