@extends('layouts.master_student')

@section('title')
  Student | Profile
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="{{ asset('admin_assets/dist/img/user.png') }}"
                 alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{  Sentinel::getUser()->first_name }}</h3>
          <p class="text-muted text-center">STDNT-{{ $user->alternate_id }}</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Email : </b> <a class="float-right">{{ Sentinel::getUser()->email }}</a>
            </li>
            <li class="list-group-item">
              <b>Address : </b> <a class="float-right">{{ Sentinel::getUser()->address }}</a>
            </li>
            <li class="list-group-item">
              <b>Contact : </b> <a class="float-right">{{ Sentinel::getUser()->phone }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-warning"> 
        <div class="card-header">
          <h3 class="card-title">Update Profile</h3>
        </div>
        <div class="card-body">
          {{-- <form action="/update_profile/{{ Sentinel::getUser()->email }}" enctype="multipart/form-data" method="POST" class="form-horizontal"> --}}
          <form action="/update_profile" method="POST" class="form-horizontal">
          {{ csrf_field() }} 
          {{ method_field('PUT') }}
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" name="full_name" class="form-control" value="{{ Sentinel::getUser()->first_name }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleSelectRounded0">Course</label>
                  <select name="courses[]" class="custom-select rounded-0"  id="courses" multiple>
                    {{-- <option selected value="{{ $student_course }}">{{ $student_course}}</option> --}}
                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input name="contact_number" type="tel" class="form-control" value="{{ Sentinel::getUser()->phone }}"  placeholder="09191234567" pattern="[0-9]{11}">
                  <small>Format: 09191234567</small><br><br>

                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Batch</label>
                  <input name="batch" type="text" class="form-control" value="{{ $user->batch }}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>School Year</label>
                  <input name="school_year" type="text" class="form-control" value="{{ $user->school_year }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-form-label" for="inputSuccess">Address</label>
                  <input name="address" type="text" class="form-control" value="{{ Sentinel::getUser()->address }}">
                </div>
              </div>
              {{-- <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleSelectBorder">Year</label>
                  <select name="year" class="custom-select form-control-border" id="exampleSelectBorder">
                    <option selected value="{{ $student_year }}">{{ $student_year }}</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                    <option value="5th Year">5th Year</option>
                  </select>
                </div>
              </div> --}}
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-block btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>   
@endsection

@section('scripts')
<!-- jQuery -->
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.js') }}"></script>

<!-- DataTables  & Plugins -->
{{-- <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
{{-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> --}}
<script>
    $(function () {
      $('#courses').val(@json(auth()->user()->courses->pluck('course_id')->toArray()))

      //Initialize Select2 Elements
      // $('.select2').select2()
      console.log('wtf');

    });
</script>  
{{-- <script>
    $(document).ready(function() {
      $('#courses').val(@json(auth()->user()->courses->pluck('id')->toArray()))
      
      // $('#example1').DataTable();
      // $('#example1').on('click', '.deletbtn', function() {
      //     $tr = $(this).closest('tr');
  
      //     var data = $tr.children("td").map(function() {
      //       return $(this).text();
      //     }).get(); 
  
      //     // console.log(data);
  
      //     $('#get_document_id').val(data[0]);
      //     $('#deleteModalForm').attr('action', '/delete_document/'+data[0]);
      //     $('#deleteModalPop').modal('show');
      });
    });
</script> --}}
{{-- <script>
    $(function () {
      bsCustomFileInput.init();
    });
</script> --}}
@endsection