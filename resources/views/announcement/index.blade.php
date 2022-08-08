@extends('layouts.master')

@section('title')
    Admin | Announcements
@endsection

@section('content')
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-m">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modal_title">Add New Announcement</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form action="{{route('announcement.store')}}" method="POST" class="form-horizontal" id="formSubmit">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <div class="input-group">
                              <div class="custom-file">
                                {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                                <input style="cursor: pointer;" type="text" name="title" class="form-control" id="title" required>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <textarea type="textarea" class="form-control" name="description" id="description" rows="5" required>

                              </textarea>
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
          <h3 class="card-title">Announcements</h3>
          <a class="btn btn-app bg-orange float-right" data-toggle="modal" data-target="#modal-lg"  id="addButton">
            <i class="fas fa-plus"></i> Add
        </a>
        </div>
        <div class="card-body">
        <table class="table">
            <thead>
              <th> Title</th>
              <th> Description</th>
              <th class="text-center"> Actions</th>
            </thead>

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

</script>
@endsection