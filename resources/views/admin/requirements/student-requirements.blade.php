@extends('layouts.master')

@section('title')
    Admin | Requirements
@endsection

@section('content')

<div class="">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Requirements</h3>
        </div>
        <div class="card-body">
            <table class="table">
              <thead>
                <th class="text-center" > Requirement</th>
                <th class="text-center" > Student Name</th>
                <th class="text-center" > Level</th>
                <th class="text-center" > Status</th>
                <th class="text-center"> Actions</th>
              </thead>
              <tbody>
                @foreach($list as $item)
                    <tr>
                        <td class="text-center">{{$item->requirement->name}}</td>
                        <td class="text-center">{{$item->student->first_name}}</td>
                        <td class="text-center">{{$item->student->studentInfo->education_level}}</td>
                        <td class="text-center">
                            @if($item->status == 1)
                            <span class="badge badge-warning">Pending</span>
                            @elseif($item->status ==2)
                            <span class="badge badge-success">Approved</span>
                            @else
                            <span class="badge badge-danger">Disapproved</span>

                            @endif
                        </td>
                        <td class="text-center">                          
                            <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" >
                                <i class="fa fa-eye" style="padding: 10px;"></i> 
                                {{-- View --}}
                            </a>
                            <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" >
                                <i class="fa fa-pen" style="padding: 10px;"></i> 
                                {{-- Edit --}}
                            </a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $(document).ready(function() {



    });
  </script>
@endsection