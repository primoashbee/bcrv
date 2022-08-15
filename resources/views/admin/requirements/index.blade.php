@extends('layouts.master')

@section('title')
    Admin | Requirements
@endsection

@section('content')
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-m">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modal_title">Add New Requirement</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form action="{{route('requirements.store')}}" method="POST" class="form-horizontal" id="formSubmit">
          {{ csrf_field() }}
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="exampleInputFile">Name</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input style="cursor: pointer;" type="text" name="name" class="form-control" id="name" required>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Description</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input type="textarea" class="form-control" name="description" id="description" required>
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
                                id="education_level"
                              >
                                <option></option>
                                <option value="College"> College Graduate</option>
                                <option value="College Undergrad"> College Undergrad</option>
                                <option value="ALS"> ALS</option>

                                <option value="High School"> High School Graduate</option>
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- college -->
<div class="card">
  <div class="card-header">
    <h3>College Requirements</h3>
    <a class="btn btn-app bg-orange float-right"  style="margin-top: -35px" data-toggle="modal" data-target="#modal-lg"  id="addButton">
      <i class="fas fa-plus"></i> Add
  </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <th> Requirement</th>
          <th> Description</th>
          <th class="text-center" > Mandatory</th>
          <th class="text-center"> Active</th>
          <th class="text-center"> Actions</th>
        </thead>
        <tbody>
          @foreach($college as $key=>$item)
          <tr>
            <td>
              {{$item->name}}
            </td>
            <td>
              {{$item->description}}
            </td>
            <td class="text-center">
              @if($item->mandatory)
              <span class="badge badge-success">{{$item->mandatory_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->mandatory_name}}</span>
              @endif

            </td>
            <td class="text-center">
              @if($item->active)
              <span class="badge badge-success">{{$item->active_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->active_name}}</span>
              @endif
            </td>

            <td class="text-center">
              <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" data="{{json_encode($item)}}">
                <i class="fa fa-pen" style="padding: 10px;"></i> 
              </a>
              <a href="{{route('requirements.uploaded'). "?requirement_id=" . $item->id}} " type="button" class="btn btn-sm btn-primary bg-info">
                <i class="fa fa-eye" style="padding: 10px;"></i> 
              </a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- college undergrad -->
<div class="card">
  <div class="card-header">
    <h3>College Undergrad Requirements</h3>
    <a class="btn btn-app bg-orange float-right"  style="margin-top: -35px" data-toggle="modal" data-target="#modal-lg"  id="addButton">
      <i class="fas fa-plus"></i> Add
  </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <th> Requirement</th>
          <th> Description</th>
          <th class="text-center" > Mandatory</th>
          <th class="text-center"> Active</th>
          <th class="text-center"> Actions</th>
        </thead>
        <tbody>
          @foreach($college_undergrad as $key=>$item)
          <tr>
            <td>
              {{$item->name}}
            </td>
            <td>
              {{$item->description}}
            </td>
            <td class="text-center">
              @if($item->mandatory)
              <span class="badge badge-success">{{$item->mandatory_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->mandatory_name}}</span>
              @endif

            </td>
            <td class="text-center">
              @if($item->active)
              <span class="badge badge-success">{{$item->active_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->active_name}}</span>
              @endif
            </td>

            <td class="text-center">
              <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" data="{{json_encode($item)}}">
                <i class="fa fa-pen" style="padding: 10px;"></i> 
              </a>
              <a href="{{route('requirements.uploaded'). "?requirement_id=" . $item->id}} " type="button" class="btn btn-sm btn-primary bg-info">
                <i class="fa fa-eye" style="padding: 10px;"></i> 
              </a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ALS  -->
<div class="card">
  <div class="card-header">
    <h3>College Undergrad Requirements</h3>
    <a class="btn btn-app bg-orange float-right"  style="margin-top: -35px" data-toggle="modal" data-target="#modal-lg"  id="addButton">
      <i class="fas fa-plus"></i> Add
  </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <th> Requirement</th>
          <th> Description</th>
          <th class="text-center" > Mandatory</th>
          <th class="text-center"> Active</th>
          <th class="text-center"> Actions</th>
        </thead>
        <tbody>
          @foreach($als as $key=>$item)
          <tr>
            <td>
              {{$item->name}}
            </td>
            <td>
              {{$item->description}}
            </td>
            <td class="text-center">
              @if($item->mandatory)
              <span class="badge badge-success">{{$item->mandatory_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->mandatory_name}}</span>
              @endif

            </td>
            <td class="text-center">
              @if($item->active)
              <span class="badge badge-success">{{$item->active_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->active_name}}</span>
              @endif
            </td>

            <td class="text-center">
              <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" data="{{json_encode($item)}}">
                <i class="fa fa-pen" style="padding: 10px;"></i> 
              </a>
              <a href="{{route('requirements.uploaded'). "?requirement_id=" . $item->id}} " type="button" class="btn btn-sm btn-primary bg-info">
                <i class="fa fa-eye" style="padding: 10px;"></i> 
              </a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- high school -->
<div class="card">
  <div class="card-header">
    <h3>High School Requirements</h3>
    <a class="btn btn-app bg-orange float-right" style="margin-top: -35px" data-toggle="modal" data-target="#modal-lg"  id="addButton">
      <i class="fas fa-plus"></i> Add
  </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <th> Requirement</th>
          <th> Description</th>
          <th class="text-center" > Mandatory</th>
          <th class="text-center"> Active</th>
          <th class="text-center"> Actions</th>
        </thead>
        <tbody>
          @foreach($high_school as $key=>$item)
          <tr>
            <td>
              {{$item->name}}
            </td>
            <td>
              {{$item->description}}
            </td>
            <td class="text-center">
              @if($item->mandatory)
              <span class="badge badge-success">{{$item->mandatory_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->mandatory_name}}</span>
              @endif

            </td>
            <td class="text-center">
              @if($item->active)
              <span class="badge badge-success">{{$item->active_name}}</span>
              @else
              <span class="badge badge-danger">{{$item->active_name}}</span>
              @endif
            </td>

            <td class="text-center">
              <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" data="{{json_encode($item)}}">
                <i class="fa fa-pen" style="padding: 10px;"></i> 
              </a>
              <a href="{{route('requirements.uploaded'). "?requirement_id=" . $item->id}} " type="button" class="btn btn-sm btn-primary bg-info">
                <i class="fa fa-eye" style="padding: 10px;"></i> 
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

      $('#addButton').click(function(){
        $('#formSubmit').attr('action','{{route('requirements.store')}}')
        $('#name').val('')
        $('#description').val('')
        $('#education_level').val('')
        $('#mandatory').prop('checked', false)
        $('#active').prop('checked', false)

        $('#modal_title').html('Add New Requirement')
      })
      $('.showUpdate').click(function(){
        const data = JSON.parse($(this).attr('data'))
        console.log(data)
        $('#modal_title').html('Update Requirement')
        const URL =  `/requirements/update/${data.id}`
        $('#formSubmit').attr('action',URL)
        $('#name').val(data.name)
        $('#description').val(data.description)
        $('#education_level').val(data.education_level)
        $('#mandatory').prop('checked',data.mandatory)
        $('#active').prop('checked',data.active)
        // console.log(JSON.parse($(this).attr('data'))
        $('#modal-lg').modal('show')
      })
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