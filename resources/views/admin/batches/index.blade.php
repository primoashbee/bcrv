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
                <h4 class="modal-title"><span id="mdlLabel"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/batch" method="POST" class="form-horizontal" id="frmModal">
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
                                        <input type="text" id="name" name="name" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Max Slot</label>
                                        <input type="integer" id="max_slot" name="max_slot" class="form-control" >
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
                                <div class="clearfix"></div>
                            
                                <div class="col-12">
                                    <hr>
                                    <h4 class="text-center"> Issued Certificate/s </h4>
                                </div>
                            </div>
                            <div id="certificate_list" class="mb-5">
                                
                                <div class="col-12 form-group">
                                    <label for="certificate_1"> Certificate Name</label>
                                    <input type="text" name="certificate[]" id="certificate_1" class="form-control">
                                </div>
                                
                            </div>
                            <button type="button" class="btn btn-success float-right" id="btnAddNewRow"> <i class="fas fa-plus"></i> </button>


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
            <form action="{{url()->current()}}" method="get" id="frmFilter">
                <div class="row">
                    <div class="col-9 form-group">
                        <label for="course_id">Course</label>
                        <select name="course_id" id="filter_course_id" class="form-control filter-control">
                            <option value=""> Please Select</option>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}"> {{$course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1 form-group">
                        <label for="batch">Batch</label>
                        <select name="batch" id="filter_batch" class="form-control filter-control">
                            <option value=""> Please Select</option>
                            @foreach($batches as $batch)
                                <option value="{{$batch}}"> {{$batch}}</option>
                            @endforeach
                        </select>      
                    </div>
                    <div class="col-1 form-group">
                        <label for="year">Year</label>
                        <select name="year" id="filter_year" class="form-control filter-control">
                            <option value=""> Please Select</option>
                            @foreach($years as $year)
                                <option value="{{$year}}"> {{$year}}</option>
                            @endforeach
                        </select>      
                    </div>
                    <div class="col-1 form-group float-right">
                        <label for="">Action</label> <br>
                        <button type="submit" class="btn btn-primary"> Filter</button>
                    </div>
                </div>
            </form>
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
                            <a href="#" type="button" class="btn btn-sm btn-warning bg-warning btnShowEdit" id="{{$batch->id}}" data="{{json_encode($batch)}}">
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
    var mdlLabel = "Create new batch"
    var current_index = 1;
    $(document).ready(function() {
        @if(request()->course_id !== null)
            $('#filter_course_id').val(@json(request()->course_id))
        @endif

        @if(request()->batch !== null)
            $('#filter_batch').val(@json(request()->batch))
        @endif

        @if(request()->year !== null)
            $('#filter_year').val(@json(request()->year))
        @endif

        $('#mdlLabel').html(mdlLabel)
        $('#example1').DataTable()
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const course_id = $(this).attr('course_id')
            $('#deleteModalForm').attr('action', '/delete_course/'+course_id);
            $('#deleteModalPop').modal('show');
        })
        $('.btnShowEdit').click(function(){
            mode = "update"
            let data = JSON.parse($(this).attr('data'))
            $('#mdlLabel').html(`Update : ${data.course.course_name} - ${data.name}`)
            $('#course_id').val(data.course_id);
            $('#name').val(data.name);
            $('#max_slot').val(data.max_slot);
            $('#year').val(data.year);
            $('#batch').val(data.batch);
            $('#course_id').attr('readonly', true);
            $('#year').attr('readonly', true);
            $('#batch').attr('readonly', true);
            $('#frmModal').attr('action', `/batch/${data.id}`);
            $("#certificate_list").children().remove();
            current_index = 1;
            
            data.certificates.map((x, index)=>{
                if(current_index == data.certificates.length){
                    $("#certificate_list").append(
                        `
                        <div class="col-12 form-group mb-4" id="col_${current_index}">
                            <label for="certificate_${current_index}"> Certificate Name </label>
                        
                            <input type="text" name="certificate[existing-${x.id}]" id="certificate_${current_index}" class="form-control" value="${x.name}">
                            <button type="button" id="deleteRow" class="btn btn-danger float-right"><i class="fas fa-minus"></i></button>

                        </div>  


                        `
                    )
                }else{
                    $("#certificate_list").append(
                        `
                        <div class="col-12 form-group mb-4" id="col_${current_index}">
                            <label for="certificate_${current_index}"> Certificate Name </label>
                        
                            <input type="text" name="certificate[existing-${x.id}]"" id="certificate_${current_index}" class="form-control" value="${x.name}">
                            
                        </div>  
                        
                        `
                    )                  
                }

                current_index++;
            });
            $('#deleteRow').click(function(e){
                    $(`#col_${current_index-1}`).remove();
            })
            $('#modal-lg').modal('show')
            $('#frmModal').append('<input type="hidden" name="_method" value="PUT" id="_method">');

        })

        $(".btn-app").click(function(){
            var mdlLabel = "Create new batch"
            $('#course_id').val('');
            $('#year').val('');
            $('#batch').val('');
            $('#max_slot').val('');
            $('#name').val('');
            $('#course_id').attr('readonly', false);
            $('#year').attr('readonly', false);
            $('#batch').attr('readonly', false);
            $('#frmModal').attr('action','batch');

            $("#certificate_list").children().remove();
            current_index = 1;
            $("#btnAddNewRow").click();
            $('#_method').remove();
            $('#mdlLabel').html(mdlLabel)

        })

        $("#frmFilter").submit(function(e){
            $.each($('.filter-control'), function(index, element){
                if($(this).val() == ''){
                    $(this).remove();
                }
            })
        })

        $('#btnAddNewRow').click(function(e){
            current_index++;
            $('#deleteRow').remove();
            $('#certificate_list').append(
                `
                <div class="col-12 form-group mb-4" id="col_${current_index}">
                    <label for="certificate_${current_index}"> Certificate Name </label>
                
                    <input type="text" name="certificate[]" id="certificate_${current_index}" class="form-control">
                    
                    <button type="button" id="deleteRow" class="btn btn-danger float-right"><i class="fas fa-minus"></i></button>
                </div>                                
                `
            )
            $('#deleteRow').click(function(e){
                    $(`#col_${current_index}`).remove();
            })
        })

    })
</script>


@endsection