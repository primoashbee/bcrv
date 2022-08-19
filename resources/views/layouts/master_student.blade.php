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
        <notification user_id="{{auth()->user()->id}}" is_admin="{{false}}"></notification>
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
    <a href="{{url('show_dashboard_students')}}" class="brand-link">
      <img src="{{ asset('admin_assets/dist/img/bcrv.png') }}" class="brand-image img-circle elevation-10" >
      <span class="brand-text font-weight-light">BCRV</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Sentinel:: check())
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="{{ asset('admin_assets/dist/img/user.png') }}" class="nav-icon img-circle elevation-2" alt="User Image">
                <p class="text-sm">
                  {{ auth()->user()->studentInfo->name }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
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
            <a href="{{ url('/show_dashboard_students') }}" class="nav-link {{ 'show_dashboard_students' == request()->path() ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>

          
          <li class="nav-item">
            <a href="{{ route('requirements') }}" class="nav-link {{ 'requirements' == request()->path() ? 'active' : '' }}">
              <i class="fa fa-list nav-icon"></i>
              <p>Requirements</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ url('/show_requests_students') }}" class="nav-link {{ 'show_requests_students' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-box nav-icon"></i>
              <p>List of Requests</p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ url('/show_responses_students') }}" class="nav-link {{ 'show_responses_students' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-inbox nav-icon"></i>
              <p>Responses from </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{ url('/show_requests_from_admins') }}" class="nav-link {{ 'show_requests_from_admins' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-file nav-icon"></i>
              <p>Requests from Admins</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/show_profile_students') }}" class="nav-link {{ 'show_profile_students' == request()->path() ? 'active' : '' }}">
              <i class="fas fa-user nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
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
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('admin_assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin_assets/dist/js/pages/dashboard2.js') }}"></script>
<!-- for the sweet alert -->
<script src="{{ url('admin_assets/js/sweetalert.js') }}"></script>
<script>
  @if (session('status'))
  swal({
    title: '{{ session('status') }}',
    icon: '{{ session('statuscode') }}',
    button: "Ok",
  });
  @endif
  
</script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
{{-- count --}}
<script>
  // $(setInterval(function(){
  //   $.ajax({
  //       url: "/newest_response_students",
  //       success: function( response ) {
  //           $('#newest_response_students').text( response );
  //       }
  //   });
  // },1000));
</script>
@yield('scripts')
</body>
</html>
