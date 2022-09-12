@extends('layouts.master')

@section('title')
    Admin | Courses
@endsection

@section('content')
    <!-- modals -->
        <!-- adding new data -->
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add a Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/add_course" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" name="course_name" class="form-control" placeholder="Enter ...">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Duration of Training (Hours)</label>
                                        <textarea class="form-control" name="course_description" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-info float-right">Add course</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        <!-- adding new data -->

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
                            <input type="hidden" name="id" class="form-control" id="get_course_id" disabled>
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
            <h3 class="card-title">Courses table</h3>
            <a class="btn btn-app bg-orange float-right" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Duration of Training (Hours)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td style="width: 75%;">{{ $course->course_name }}</td>
                        <td style="width: 10%;">{{ $course->course_description }}</td>
                        <td style="width: 15%;">
                            <a href="/show_edit_course/{{ $course->id }}" type="button" class="btn btn-primary bg-info">
                                <i class="fa fa-pen" style="padding: 10px;"></i> 
                            </a>
                            <a href="/batches?course_id={{$course->id}}" class="btn btn-warning" course_id="{{ $course->id }}">
                                <i class="fa fa-layer-group" style="padding: 10px;"></i>
                            </a>
                            <a href="#" class="btn btn-primary bg-danger btn-delete" course_id="{{ $course->id }}">
                                <i class="fa fa-trash" style="padding: 10px;"></i> 
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Duration of Training (Hours)</th>
                        <th>Actions</th>
                    </tr>
                </tfoot> --}}
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
    $.noConflict();
    $(document).ready(function() {
        
        $('#example1').DataTable()
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const course_id = $(this).attr('course_id')
            $('#deleteModalForm').attr('action', '/delete_course/'+course_id);
            $('#deleteModalPop').modal('show');
        })
    })
</script>


@endsection