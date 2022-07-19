@extends('layouts.master_student')

@section('title')
    Students | Documents
@endsection

@section('content')
    <!-- modals -->
        <!-- adding new data -->
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/add_document_students" enctype="multipart/form-data" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                          <div class="custom-file">
                                            {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                                            <input style="cursor: pointer;" type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>File Description</label>
                                    <textarea class="form-control" name="file_description" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-info float-right">Add File</button>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        <!-- adding new data -->
    <!-- /.modal -->

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Documents table</h3>
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
                        <th>Document Name</th>
                        <th>Description</th>
                        <th>File Size</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentdocuments->where('submitted_by', Sentinel::getUser()->first_name) as $document)
                    <tr>
                        <td style="width: 100px">{{ $document->id }}</td>
                        <td style="width: 100px">{{ $document->file_name }}</td>
                        <td style="width: 100px">{{ $document->description }}</td>
                        <td style="width: 100px">{{ $document->size }} Bytes</td>
                        <td style="width: 100px">{{ $document->datetime }}</td>
                        
                        <td style="width: 190px;">
                            <a href="{{ url('/download_document', $document->file_name) }}" type="button" class="btn btn-sm btn-primary bg-warning">
                                <i class="fa fa-download" style="padding: 10px;"></i> Download
                            </a>
                            <a href="/show_edit_documents_students/{{ $document->id }}" type="button" class="btn btn-primary bg-info">
                                <i class="fa fa-pen" style="padding: 10px;"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Document Name</th>
                        <th>Description</th>
                        <th>File Size</th>
                        <th>Date Created</th>
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