@extends('layouts.master')

@section('title')
    Admin | Requests to Students
@endsection

@section('content')

 <!-- adding new data -->
 <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add a Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="/add_request_to" method="POST" class="form-horizontal">
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="exampleSelectBorder">Request to</label>
                            <select name="student_email" class="custom-select form-control-border" id="exampleSelectBorder">
                                <option selected value="">Please Select Student...</option>
                                @foreach ($users as $user)
                                    @foreach ($students->where('email', '=', $user->email) as $student)
                                        <option value="{{ $student->email }}">{{ $student->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Document name</label>
                            <input type="text" name="document_name" class="form-control" placeholder="Enter ...">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-block btn-info float-right">Add Request</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
<!-- adding new data -->

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Requests table</h3>
            <a class="btn btn-app bg-orange float-right" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Student Name</th>

                        <th>Document Name</th>
                        <th>Request Date</th>
                        <th>Request from</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests_toStudents as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>STDNT-{{ $request->user->studentInfo->alternate_id }}</td>
                        <td>{{ $request->user->studentInfo->name }}</td>
                        <td>{{ $request->document_name }}</td>
                        <td>{{ $request->date_of_request }}</td>
                        <td>{{ $request->request_from }}</td>
                        @if ($request->status == 'pending')
                            <b><td class="text-success">Pending</td></b>
                        @elseif ($request->status == 'finished')
                            <b><td class="text-warning">Finished</td></b>
                        @endif
                        @if ($request->response_status == 'requested')
                            <b><td class="text-success">Requested</td></b>
                        @elseif ($request->response_status == 'responded')
                            <b><td class="text-info">Responded</td></b>
                        @endif
                        <td style="width: 210px;">
                            @if ($request->response_status == 'responded')
                                <a href="{{ url('/download_response_from_student', $request->id) }}" type="button" class="btn btn-sm btn-primary bg-warning">
                                    <i class="fa fa-download" style="padding: 10px;"></i> Download
                                </a>
                            @else 
                                <strong><p style="width: 100px" class="text-success">Waiting for Response</p></strong>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Document Name</th>
                        <th>Request Date</th>
                        <th>Request from</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection
    
@section('scripts')
<!-- jQuery -->
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $(document).ready(function() {
      $('#example1').DataTable();
      $('#example1').on('click', '.deletbtn', function() {
          $tr = $(this).closest('tr');
  
          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get(); 
  
          // console.log(data);
  
          $('#get_course_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_course/'+data[0]);
          $('#deleteModalPop').modal('show');
      });
    });
  </script>
@endsection