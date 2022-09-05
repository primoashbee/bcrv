@extends('layouts.master')

@section('title')
    Admin | Batches
@endsection

@section('content')

        <!-- adding new data -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title"><span id="mdlLabel">Create New Batch</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/batch" method="POST" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Course </label>
                                        <select name="course_id" class="form-control" id="course_id">
                                            <option value=""> Please Select </option>
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}"> {{$course->course_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Name</label>
                                        <input type="text" name="name" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Max Slot</label>
                                        <input type="integer" name="max_slot" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Batch </label>
                                        <select name="batch" class="form-control" id="batch">
                                            <option value=""> Please Select </option>
                                            @foreach($batches as $batch)
                                            <option value="{{$batch}}"> {{$batch}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Year </label>
                                        <select name="year" class="form-control" id="year">
                                            <option value=""> Please Select </option>
                                            @foreach($years as $year)
                                            <option value="{{$year}}"> {{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-info float-right"><span id="btnLabel">Submit</span></button>
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
            <h3 class="card-title">Batches table</h3>
            <a class="btn btn-app bg-orange float-right" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Name</th>
                        <th>Batch</th>
                        <th>Year</th>
                        <th>Slots</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $batch)
                    <tr>
                        <td> {{$batch->course->course_name}}</td>
                        <td> {{$batch->name}}</td>
                        <td> {{$batch->batch}}</td>
                        <td> {{$batch->year}}</td>
                        <td> {{$batch->users()->count() . '/' . $batch->max_slot}}</td>
                        <td> 
                            <a href="{{route('batch.manage.show', $batch->id)}}" type="button" class="btn btn-sm btn-primary bg-info">
                                <i class="fa fa-users" style="padding: 10px;"></i>
                            </a> 
                            <a href="{{route('batch.manage.show', $batch->id)}}" type="button" class="btn btn-sm btn-primary bg-info">
                                <i class="fa fa-edit" style="padding: 10px;"></i>
                            </a> 

                        </td>
                    </tr>
                    @endforeach
                </tbody>
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