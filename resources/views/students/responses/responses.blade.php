@extends('layouts.master_student')

@section('title')
    Student | Responses
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Responses table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Request ID</th>
                        <th>Student ID</th>
                        <th>Document Name</th>
                        <th>Request Date</th>
                        <th>Release Date</th>
                        <th>Processing Officer</th>
                        <th>Status</th>
                        <th>Date Sent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responses->where('student_id', $student_id) as $response)
                    <tr>
                        <td style="width: 100px">{{ $response->id }}</td>
                        <td style="width: 100px">STDNT-{{ $response->student_id }}</td>
                        <td style="width: 100px">RQ-{{ $response->request_id }}</td>
                        <td style="width: 100px">{{ $response->file_name }}</td>
                        <td style="width: 100px">{{ $response->request_date }}</td>
                        <td style="width: 100px">{{ $response->release_date }}</td>
                        <td style="width: 100px">{{ $response->processing_officer }}</td>
                        <td style="width: 100px" class="text-success"><strong>{{ $response->status }}</strong></td>
                        <td style="width: 100px">{{ $response->date_sent }}</td>
                        @if ($response->status == 'received')
                            <td>
                                <a href="{{ url('/download_document_students', $response->file_name) }}" type="button" class="btn btn-sm btn-primary bg-warning">
                                    <i class="fa fa-download" style="padding: 10px;"></i> Download
                                </a>
                            </td>
                        @else
                            <strong><td style="width: 100px" class="text-success">No action available</td></strong>
                        @endif
                        
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Request ID</th>
                        <th>Student ID</th>
                        <th>Document Name</th>
                        <th>Request Date</th>
                        <th>Release Date</th>
                        <th>Processing Officer</th>
                        <th>Status</th>
                        <th>Date Sent</th>
                        <th>Action</th>
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
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.js') }}"></script>

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
<script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
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
  
          $('#get_document_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_document/'+data[0]);
          $('#deleteModalPop').modal('show');
      });
    });
</script>
<script>
    $(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection