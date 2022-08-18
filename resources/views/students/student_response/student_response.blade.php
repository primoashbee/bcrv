@extends('layouts.master_student')

@section('title')
    Student | Requests from Admin
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Requests table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Document Name</th>
                        <th>Request Date</th>
                        <th>Request from</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests_toStudents->where('student_id', $current_user->id) as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>STDNT-{{ $student_info->alternate_id }}</td>
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
                            <b><td class="text-warning">Responded</td></b>
                        @endif
                        <td style="width: 210px;">
                            @if ($request->response_status == 'responded')
                                {{-- <strong><p style="width: 100px" class="text-success">You Responded</p></strong> --}}
                                <a href="{{route('request.to.student.view', $request->id)}}" type="button" target ="_blank" class="btn-sm btn-primary bg-info">
                                    <i class="fa fa-eye" style="padding: 10px;"></i>
                                </a>
                                <a href="{{route('request.to.student.download', $request->id)}}" type="button" class="btn-sm btn-primary bg-success">
                                    <i class="fa fa-download" style="padding: 10px;"></i>
                                </a>
                                <a href="#" type="button" class="btn-sm btn-primary bg-danger btn-undo" id="{{$request->id}}">
                                    <i class="fa fa-undo" style="padding: 10px;"></i>
                                </a>

                            @else 
                                <a href="/respond_to_request_from_admin/{{ $request->id }}" type="button" class="btn-sm btn-primary bg-warning">
                                    <i class="fa fa-check" style="padding: 10px;"></i>
                                </a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
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
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
<script>
//   $(function () {
//     $("#example1").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//   });
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
      $('.btn-undo').click(async function(e){
        e.preventDefault();
        const id = $(this).attr('id')
        const res = await axios.post(`/admin-request-to-student/unsend/${id}`);
        location.reload();
      })
    });
  </script>
@endsection