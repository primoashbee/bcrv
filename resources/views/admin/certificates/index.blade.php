@extends('layouts.master')

@section('title')
    Admin | Issued Certificates
@endsection

@section('content')
<div class="modal fade" id="mdlForm">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title"><span id="mdlLabel">Upload Certificate</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <input type="hidden" id="batch_certificate_id" name="batch_certificate_id">
                
                <div class="form-group">

                    <label for="file_upload">Upload Certificate </label> 

                    <div class="input-group">
                       <div class="custom-file">
                            <input type="file" name="file_upload" id="file_upload" class="custom-file-input" style="cursor: pointer;" accept="image/*, application/pdf"> 
                            <label for="exampleInputFile" class="custom-file-label" id="lblFileName">Choose file</label>
                        </div>
                    </div>
                    <div id="show_uploaded">
                        <a href="#" target="_blank" class="badge badge-success" id="lnkView"><i class="fa fa-eye"></i></a>
                        <a href="#"  class="badge badge-success" id="lnkDownload"><i class="fa fa-download"></i></a>
                        <span> Submitted on: <span id="lblUploadedAt"></span>                    
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-block btn-info float-right" id="btnUpload"><span id="btnLabel">Submit</span></button>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Certificates </h3>
            {{-- <a class="btn btn-app bg-orange float-right" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i> Add
            </a> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
            <div>
                <table id="tblList" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Learner ID</th>
                            <th scope="col">LastName</th>
                            <th scope="col">FirstName   </th>
                            <th scope="col">MiddleName</th>
                            <th scope="col">Extension Name</th>
                            <th scope="col">Certificate</th>
                            <th scope="col">Training Status</th>
                            <th scope="col">Upload Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $key=>$item)
                        <tr class="xxx">
                            <td>LEARNERS ID</td>
                            <td>{{$item->user->studentInfo->lastname}}</td>
                            <td>{{$item->user->studentInfo->firstname}}</td>
                            <td>{{$item->user->studentInfo->middlename}}</td>
                            <td>{{$item->user->studentInfo->ext_name}}</td>
                            <td>{{$item->certificate->name}}</td>
                            <td>
                                @if($item->pivot()->status == 1 )
                                <span class="badge badge-pill badge-success">Completed</span>

                                @elseif($item->pivot()->status == 2)
                                <span class="badge badge-pill badge-danger">Not Completed</span>

                                @else($student->pivot->status == 3)
                                <span class="badge badge-pill badge-dark">Backed Out</span>
                                @endif
                            </td>
                            <td>
                                @if($item->upload_status)
                                <span class="badge badge-pill badge-success">Uploaded</span>
                                @else
                                <span class="badge badge-pill badge-danger">Empty</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" type="button" class="btn-sm btn-upload btn-primary bg-warning" data="{{json_encode($item)}}">
                                    <i class="fa fa-file" style="padding: 10px;"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
<script defer>
    $.noConflict();
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
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const course_id = $(this).attr('course_id')
            $('#deleteModalForm').attr('action', '/delete_course/'+course_id);
            $('#deleteModalPop').modal('show');
        })
        
        $("#frmFilter").submit(function(e){
            $.each($('.filter-control'), function(index, element){
                if($(this).val() == ''){
                    $(this).remove();
                }
            })
        })

        $('.btn-upload').click(function(){
            const data = JSON.parse($(this).attr('data'))
            $("#batch_certificate_id").val(data.id);
            $('#mdlLabel').html(`${data.certificate.name} - ${data.user.student_info.name}`)
            if(data.path === null){
                $('#show_uploaded').hide()
            }else{
                $('#lnkView').attr('href', `/issued_certificates/${data.id}/view`);
                $('#lnkDownload').attr('href', `/issued_certificates/${data.id}/download`);
                $('#show_uploaded').show()

            }
            $('#mdlForm').modal('show')
        })

        $('#btnUpload').click(async function(){
            const file = $('#file_upload')[0].files[0];

            const batch_certificate_id =  $("#batch_certificate_id").val();
            let formData = new FormData();

            formData.append('batch_certificate_id', batch_certificate_id );
            console.log(file)
            formData.append('file', file);
            const {data} = await axios.post(`/issued_certificates/${batch_certificate_id}`, formData ,{
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            });
            const alert = await Swal.fire(data.message, '', 'success')
            location.reload()

            
        })

        $('#tblList').DataTable()

    })
</script>


@endsection