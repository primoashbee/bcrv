@extends('layouts.master_student')

@section('title')
    Student | Requests
@endsection

@section('content')
    <!-- modals -->
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
                        <form action="/add_request_students" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Select Document</label>
                                            <select name="document_name" class="form-control select2" style="width: 100%; height: 100%;">
                                                <option value="NULL" selected>Select file...</option>
                                                @foreach ($documents as $document)
                                                    <option value="{{ $document->id }}">{{ $document->filename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    {{-- <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputRounded0">Number of Copies</label>
                                                <input name="number_of_copies" type="number" class="form-control rounded-0" id="exampleInputRounded0" value="1">
                                            </div>
                                        </div>
                                    </div> --}}
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
    <!-- /.modal -->

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
                        <th>Document Name</th>
                        {{-- <th>No. of Copies</th> --}}
                        <th>Request Date</th>
                        <th>Release Date</th>
                        <th>Processing Officer</th>
                        <th>Is Signed</th>
                        <th>Status</th>
                        <th style="max-width: 200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($requests as $key=>$item)
                            
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td >STDNT - {{ $item->student_id }}</td>
                            <td >{{ $item->document->filename }}</td>
                            {{-- <td style="width: 10px;">{{ $request->number_of_copies }}</td> --}}
                            <td>{{ $item->date_of_request }}</td>
                            <td>{{ $item->release_date }}</td>
                            <td >{{ $item->processing_officer }}</td>
                            <td>{{ $item->document->signed_name }}</td>
                            @if ($item->is_responded == '1')
                                <b><td class="text-success">Received</td></b>
               
                            @else 
                                <b><td class="text-warning">Pending</td></b>
                            @endif
                            @if ($item->is_responded == "1")
                                <strong>
                                    <td class="text-success">
                                        {{-- Finished Transaction --}}
                                        <a href="{{route('request.preview', $item->id)}}" type="button" target ="_blank" class="btn-sm btn-primary bg-info">
                                            <i class="fa fa-eye" style="padding: 10px;"></i>
                                        </a>
                                        <a href="{{route('request.download', $item->id)}}" type="button" class="btn-sm btn-primary bg-success">
                                            <i class="fa fa-download" style="padding: 10px;"></i>
                                        </a>
                                        <a href="#" type="button" class="btn-sm btn-primary bg-danger btn-delete" id="{{$item->id}}">
                                            <i class="fa fa-trash" style="padding: 10px;"></i>
                                        </a>
                                    </td>
                                </strong>
 
                            @else 
                                <td >
                                    
    
                                    <a href="/show_edit_request_students/{{ $item->id }}" type="button" class="btn-sm btn-primary bg-info">
                                        <i class="fa fa-pen" style="padding: 10px;"></i>
                                    </a>
                                    <a href="#" type="button" class="btn-sm btn-primary bg-danger btn-delete" id="{{$item->id}}">
                                        <i class="fa fa-trash" style="padding: 10px;"></i>
                                    </a>

                                    
                                    {{-- <a href="/receive_request/{{ $item->id }}" type="button" class="btn-sm btn-primary bg-success">
                                        <i class="fa fa-download" style="padding: 10px;"></i> 
                                    </a>    --}}
                                </td>
                            @endif

                                    
                               
                        </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Document Name</th>
                        {{-- <th>No. of Copies</th> --}}
                        <th>Request Date</th>
                        <th>Release Date</th>
                        <th>Processing Officer</th>
                        <th>Is Signed</th>
                        <th>Status</th>
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
  $(function () {
    $('#push-menu-hamburger').click(function(e){
        const el = $('body'); 
        if(el.hasClass('sidebar-collapse')){
          el.removeClass('sidebar-collapse')
        }else{
          el.addClass('sidebar-collapse')

        }
      })
    $('.btn-delete').click(function(){
            const id = $(this).attr('id')
            Swal.fire({
                    title: 'Are you sure you want to delete this request?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: `Cancel`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        console.log(axios);
                        axios.delete(`/delete_request/${id}`).then((res)=>{
                            location.reload();
                        })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
        
        })
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example1').DataTable();

  });

</script>
@endsection