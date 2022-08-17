@extends('layouts.master')

@section('title')
    Admin | Students
@endsection

@section('content')
    <!-- modals -->
        <!-- adding new data -->
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/add_student" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputRounded0">Complete Name</label>
                                            <input name="complete_name" type="text" class="form-control rounded-0" id="exampleInputRounded0" placeholder="Complete Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputRounded0">Email</label>
                                            <input name="email" type="text" class="form-control rounded-0" id="exampleInputRounded0" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputRounded0">Contact</label>
                                            <input name="contact_number" type="text" class="form-control rounded-0" id="exampleInputRounded0" placeholder="Contact Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Select Course</label>
                                            <select name="course" class="form-control select2" style="width: 100%; height: 100%;">
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Year</label>
                                            <select name="year" class="custom-select form-control-border" id="exampleSelectBorder">
                                            <option value="1st Year">1st Year</option>
                                            <option value="2nd Year">2nd Year</option>
                                            <option value="3rd Year">3rd Year</option>
                                            <option value="4th Year">4th Year</option>
                                            <option value="5th Year">5th Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-info float-right">Add Student</button>
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
            <h3 class="card-title">Students table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student No.</th>
                        <th>Email</th>
                        <th>Complete Name</th>
                        <th>Course</th>
                        {{-- <th>Year</th> --}}
                        <th>Batch</th>
                        <th>School Year</th>
                        <th>Contact</th>
                        <th>Account</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>STDNT-{{ $student->alternate_id }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->user->courseList}}</td>
                        {{-- <td>{{ $student->year }}</td> --}}
                        <td> {{$student->batch}}</td>
                        <td> {{$student->school_year}}</td>
                        <td>{{ $student->contact_number }}</td>
                        @if ($student->status == 0)
                            <b><td class="text-danger">Inactive</td></b>
                        @else
                            <b><td class="text-success">Active</td></b>
                        @endif
                        <td style="width: 190px;">
                            <a href="/show_edit_student/{{ $student->id }}" type="button" class="btn btn-sm btn-primary bg-info">
                                <i class="fa fa-pen" style="padding: 10px;"></i> 
                            </a>
                            <a href="#" type="button" class="btn btn-sm btn-primary bg-danger btn-delete" student_id="{{$student->id}}">
                                <i class="fa fa-trash" style="padding: 10px;"></i> 
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Student No.</th>
                        <th>Complete Name</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Account</th>
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
        $('.btn-delete').click(function(e){
            e.preventDefault();
            var id = $(this).attr('student_id')
            console.log(id)
            Swal.fire({
                    title: 'Do you want to delete this record?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: `Cancel`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post(`/student/delete/${id}`).then(()=>{
                            location.reload()
                        })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
        })
        $('#example1').DataTable();
        $('#example1').on('click', '.deletbtn', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
            return $(this).text();
            }).get(); 

            // console.log(data);

            $('#get_student_id').val(data[0]);
            $('#deleteModalForm').attr('action', '/delete_student/'+data[0]);
            $('#deleteModalPop').modal('show');
        });
    });
</script>
@endsection