@extends('layouts.master')

@section('title')
    Admin | Batches
@endsection

@section('content')
    <a href="/batches" style="text-decoration: none; color:black"><h4> &laquo; Go Back </h4> </a>

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
    <div class="card">
        <div class="card-header">
            <h1> {{ $batch->course->course_name}} - {{ $batch->name}} </h1>
            <p> 
                Batch: {{ $batch->batch}}<br>
                Year: {{ $batch->year}} <br>
                Slots: {{ $batch->users()->count() . '/' . $batch->max_slot }}
            </p>

        </div>
        <div class="card-body">
            <div class="bd-example bd-example-tabs">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Enlisted Students</button>
                    <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Enlist Student/s</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card">
                        <div class="card-header">
                            Enlisted Students
                            <div class="dropdown show float-right btn-primary">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mark As <span id="lblEnlisted"> </span>
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#" onClick="markAs(1)">Completed</a>
                                    <a class="dropdown-item" href="#" onClick="markAs(2)">Not Completed</a>
                                    <a class="dropdown-item" href="#" onClick="markAs(3)">Backed Out</a>
                                    <a class="dropdown-item" href="#" onClick="markAs(4)">Remove</a>
                                </div>
                                </div>
                        </div>
                        <div class="card-body">
                            <table id="tblEnlisted" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Learner's ID</th>
                                        <th>LastName</th>
                                        <th>FirstName</th>
                                        <th>Training Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($batch->users as $student)
                                        <tr>
                                            <td style="width:5px"> <input type="checkbox" name="student_id[]" class="chkEnlisted" id="student-{{$student->id}}" value="{{$student->id}}"/> </td>
                                            <td> {{$student->learner->learner_id}}</td>
                                            <td> {{$student->studentInfo->firstname}}</td>
                                            <td> {{$student->studentInfo->lastname}}</td>
                                            <td>
                                            @if($student->pivot->status == 1 )
                                            <span class="badge badge-pill badge-success">Completed</span>
        
                                            @elseif($student->pivot->status == 2)
                                            <span class="badge badge-pill badge-danger">Not Completed</span>
        
                                            @else($student->pivot->status == 3)
                                            <span class="badge badge-pill badge-dark">Backed Out</span>
                                            @endif
                                            </td>
                                            {{-- <td>
                                                <a href="{{route('batch.manage.show', $student->id)}}" type="button" class="btn btn-sm btn-primary bg-info">
                                                    <i class="fa fa-users" style="padding: 10px;"></i>
                                                </a> 
                                                <a href="{{route('batch.manage.show', $student->id)}}" type="button" class="btn btn-sm btn-primary bg-info">
                                                    <i class="fa fa-edit" style="padding: 10px;"></i>
                                                </a> 
                        
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>  
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card">
                        <div class="card-header">
                            Enlist Students
                            <button class="btn btn-primary float-right" id="btnEnlist"> Enlist Selected <span id="lblEnlistCount"></span> </button>
        
                        </div>
                        <div class="card-body">
        
                            <table id="tblToEnlist" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th>Learner's ID</th>
                                        <th>LastName</th>
                                        <th>FirstName</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($toEnlist as $student)
                                    <tr>
                                        <td style="width:5px"> 
                                            <input type="checkbox" name="student_id[]" class="chkEnlist" id="enlist-student-{{$student->id}}" value="{{$student->id}}"/>
                                        </td>
                                        <td> <label for="enlist-student-{{$student->id}}"> {{ $student->learner->learner_id}} </label></td>
                                        <td> {{$student->studentInfo->firstname}}</td>
                                        <td> {{$student->studentInfo->lastname}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    var enlist = [];
    var enlist_profile = [];
    var enlist_length = 0;
    var batch_id = @json($batch_id);
    var open_slots = @json($batch->max_slot - $batch->users()->count());
    var occupied_slots = @json($batch->users()->count());
    const max_slot = @json($batch->max_slot);
    var enlisted_selected = [];
    var enlisted_selected_length = 0;
    function markAs(status){
            if(enlisted_selected_length == 0){
                return false;
            }

            var status_text = "Completed";
            if(status == 1){
                status_text = "Completed"
            }
            if(status == 2){
                status_text = "Not Completed"
            }
            if(status == 3){
                status_text = "Backed Out"
            }
            if(status == 4){
                status_text = "Removed"
            }

            Swal.fire({
                    title: `Mark selected students (${enlisted_selected_length}) as ${status_text}?`,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: `Cancel`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const form = {
                            user_ids : enlisted_selected,
                            status   : status
                        }
                        axios.put(`/batch/manage/${batch_id}`, form)
                            .then(res=>{

                                Swal.fire(res.data.message, '', 'success').then(resx=>{ location.reload()})
                                // Swal.fire('Student/s successfully enlisted', '', 'success').then(resx=>{ location.reload()})
                            })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
    }
    $.noConflict();

    $(document).ready(function() {

 
        const tblEnlisted = $('#tblEnlisted').DataTable()
        const tblEnlist = $('#tblToEnlist').DataTable({
            autoWidth: false
        })

        $('#tblToEnlist').on('click','.chkEnlist', function(){
            if($(this).prop('checked')){
                enlist.push($(this).val())
                enlist_length = length = enlist.length
            }else{
                enlist = enlist.filter(x=>x!=$(this).val())
                enlist_length = length = enlist.length

            }
           $("#lblEnlistCount").html('('+enlist.length+')');
        });

        $('#tblEnlisted').on('click','.chkEnlisted', function(){
            if($(this).prop('checked')){
                enlisted_selected.push($(this).val())
                enlisted_selected_length = enlisted_selected.length
            }else{
                enlisted_selected = enlist.filter(x=>x!=$(this).val())
                enlisted_selected_length = enlisted_selected.length

            }

            $("#lblEnlisted").html('('+enlisted_selected_length+')');
        });
 

        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const course_id = $(this).attr('course_id')
            $('#deleteModalForm').attr('action', '/delete_course/'+course_id);
            $('#deleteModalPop').modal('show');
        })

        $('#btnEnlist').click(function(){
            if(enlist_length == 0){
                return false;
            }
            if(enlist_length + occupied_slots > max_slot ){
                if(open_slots == 0){
                    Swal.fire(`All slots are occupied.`, '', 'error')
                    return;
                }
                Swal.fire(`Open slot/s is only ${open_slots}. You're trying to enlist more than ${open_slots} (${enlist_length})`, '', 'error')
                return;
            }
            Swal.fire({
                    title: `Confirm enlistment of ${enlist_length} students?`,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: `Cancel`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const form = {
                            user_ids : enlist
                        }
                        axios.post(`/batch/manage/${batch_id}`, form)
                            .then(res=>{
                                Swal.fire('Student/s successfully enlisted', '', 'success').then(resx=>{ location.reload()})
                            })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
        })



        
    })
</script>


@endsection