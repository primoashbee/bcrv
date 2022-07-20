@extends('layouts.master')

@section('title')
    Admin | Requirements
@endsection

@section('content')
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-m">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Add New Requirement</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form action="{{route('requirements.store')}}" method="POST" class="form-horizontal">
          {{ csrf_field() }}
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="exampleInputFile">Name</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input style="cursor: pointer;" type="text" name="name" class="form-control" required>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Description</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input type="textarea" class="form-control" name="description" required>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Education Level</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <select
                                name="education_level"
                                class="form-control"
                              >
                                <option></option>
                                <option value="High School"> High School Graduate</option>
                                <option value="College"> College Graduate</option>
                              </select>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-inline">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="mandatory" name="mandatory">
                              <label class="custom-control-label" for="mandatory"> Mandatory</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-inline">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="active" name="active">
                              <label class="custom-control-label" for="active"> Active</label>
                            </div>
                          </div>
                        </div>
                      </div>


                     
                  </div>
              </div>

          </div>
          <div class="card-footer">
          <button type="submit" class="btn btn-block btn-info float-right">Submit</button>
          </div>
          </form>
      </div>
  </div>
  </div>
</div>
<div class="">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Requirements</h3>
          <a class="btn btn-app bg-orange float-right" data-toggle="modal" data-target="#modal-lg">
            <i class="fas fa-plus"></i> Add
        </a>
        </div>
        <div class="card-body">

            <h1>College Level</h1>
            <table class="table">
              <thead>
                <th> Requirement</th>
                <th class="text-center"> Status</th>
              </thead>
              <tbody>
                @foreach($list as $key=>$item)
                <tr>
                  <td>
                    {{$item}}
                  </td>
                  <td class="text-center">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{$key}}">
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            
            <hr>

            <h1>High School Level</h1>
            
            <table class="table">
              <thead>
                <th> Requirement</th>
                <th class="text-center"> Status</th>
              </thead>
              <tbody>
                @foreach($list as $key=>$item)
                <tr>
                  <td>
                    {{$item}}
                  </td>
                  <td class="text-center">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck{{$key}}">
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
      $('#example1').DataTable();
      $('#example1').on('click', '.deletbtn', function() {
          $tr = $(this).closest('tr');
  
          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get(); 
  
          // console.log(data);
  
          $('#get_course_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_course/'+data[0]);
          $('#deleteModalPop').modal('show');
      });
    });
  </script>
@endsection