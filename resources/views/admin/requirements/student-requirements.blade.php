@extends('layouts.master')

@section('title')
    Admin | Requirements
@endsection

@section('content')
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-m">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modal_title"></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form action="" method="POST" class="form-horizontal" id="formSubmit">
            @method('patch')

            {{ csrf_field() }}
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="exampleInputFile">Name</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input style="cursor: pointer;" type="text" name="name" class="form-control" id="name" readonly>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Submitted On</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input type="textarea" class="form-control" name="created_at" id="created_at" readonly>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Status</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <select
                                name="status"
                                class="form-control"
                                id="status"
                              >
                                <option></option>
                                <option value="1"> Pending </option>
                                <option value="2"> Approve </option>
                                <option value="4"> Reject</option>
                              </select>
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
<div class="col-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Requirements</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-lg-4 col-sm-12">
              <label for="search">Search</label>
              <input type="text" name="q" id="q" class="form-control">
            </div>
            <div class="col-lg-5 col-sm-12">

            </div>
            <div class="form-group col-lg-2 col-sm-6">
              <label for="q_status">Status</label>
              <select class="form-control" name="q_status" id="q_status">
                <option value="all">All</option>
                <option value="1">Pending</option>
                <option value="2">Approved</option>
                <option value="4">Rejected</option>
              </select>
            </div>
            <div class="form-group col-lg-1 col-sm-6">
              <label for="submit">&nbsp;</label><br>
              <input type="submit" class="btn btn-primary" id="btnSearch" value="Search">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <th class="" > Requirement</th>
                <th class="" > Student Name</th>
                <th class="text-center" > Level</th>
                <th class="text-center" > Status</th>
                <th class="text-center"> Actions</th>
              </thead>
              <tbody>
                @foreach($list as $item)
                    <tr>
                        <td class="">{{$item->requirement->name}}</td>
                        <td class="">{{$item->student->first_name}}</td>
                        <td class="text-center">{{$item->student->studentInfo->education_level}}</td>
                        <td class="text-center">
                            @if($item->status == 1)
                            <span class="badge badge-warning">Pending</span>
                            @elseif($item->status ==2)
                            <span class="badge badge-success">Approved</span>
                            @else
                            <span class="badge badge-danger">Rejected</span>

                            @endif
                        </td>
                        <td class="text-center">                          
                            <a href="{{route("requirements.view", $item->id)}}" type="button" class="btn btn-sm btn-primary bg-info showUpdate"  >
                                <i class="fa fa-eye" style="padding: 10px;"></i> 
                            </a>

                            <a href="{{route("requirements.download", $item->id)}}" type="button" class="btn btn-sm btn-primary bg-info showUpdate"  >
                                <i class="fa fa-download" style="padding: 10px;"></i> 
                                {{-- View --}}
                            </a>
                            <a href="#" type="button" class="btn btn-sm btn-primary bg-info showUpdate" data="{{json_encode($item)}}" student="{{$item->student->first_name}}" requirement_type="{{$item->requirement->name}}">
                                <i class="fa fa-pen" style="padding: 10px;"></i> 
                                {{-- Edit --}}
                            </a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{$list->links()}}
          </div>
        </div>
    </div>1
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

      @if($requirement != null)
        const data = @json($requirement);
        console.log(data)
        const URL  = `/requirements/${data.id}`
        const type = data.student.first_name +  ' - ' + data.requirement.name

        $('#formSubmit').attr('action',URL)
        $('#name').val(data.filename);
        $('#created_at').val(data.created_at);
        $('#status').val(data.status);
        $('#modal_title').html(type);
        $('#modal-lg').modal('show')

      @endif
      $('#btnSearch').click(function(){
        const q = $('#q').val();
        const q_status = $('#q_status').val();

        var s_url = new URL('{{route('requirements.uploaded')}}');
        if(q!=""){
          s_url.searchParams.append('q', q);
        }
        if(q_status != "all"){
          s_url.searchParams.append('status', q_status);
        }
        window.location.href=s_url
        
      });
      $('.showUpdate').click(function(){
        const data = JSON.parse($(this).attr('data'))
        const URL  = `/requirements/${data.id}`
        const type = $(this).attr('student') + ' - ' + $(this).attr('requirement_type')
        console.log(type)
        $('#formSubmit').attr('action',URL)
        $('#name').val(data.filename);
        $('#created_at').val(data.created_at);
        $('#status').val(data.status);
        $('#modal_title').html(type);
        

        $('#modal-lg').modal('show')
      })


    });
  </script>
@endsection