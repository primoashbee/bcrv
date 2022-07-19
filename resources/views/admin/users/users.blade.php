@extends('layouts.master')

@section('title')
    Admin | Requests
@endsection

@section('content')
    <!-- modals -->
        <!-- deleting data -->
            <!-- Modal For confirm delete -->
                <div class="modal fade" id="deleteModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                
                        <form id="deleteModalForm" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="modal-body">
                        <div class="form-group">
                            <h5>Are you sure you want to delete this record?</h5>
                            <input type="hidden" name="id" class="form-control" id="get_user_id" disabled>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Delete</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
        <!-- deleting data -->
    <!-- /.modal -->

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
                        <th>Complete Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->designation }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        @foreach($user->roles as $roles)
                            <td>- {{ $roles->name }}</td>
                        @endforeach
                        @if ($user->status == 0)
                            <b><td class="text-danger">Inactive</td></b>
                        @else
                            <b><td class="text-success">Active</td></b>
                        @endif

                        <td>
                            <a href="/show_edit_user/{{ $user->id }}" type="button" class="btn btn-primary bg-info">
                                <i class="fa fa-pen" style="padding: 10px;"></i> Edit
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary bg-danger deletbtn">
                                <i class="fa fa-trash" style="padding: 10px;"></i> Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Complete Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
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
  
          $('#get_user_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_user/'+data[0]);
          $('#deleteModalPop').modal('show');
      });
    });
  </script>
@endsection