@extends('layouts.master')

@section('title')
    Admin | Document - Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            You are about to edit a a document
            <a href="/show_students" type="button" class="btn btn-info bg-info float-right" style="text-decoration: none;">
                <i class="fa fa-arrow-left" style="padding: 10px;"></i> Return
            </a>
            <div class="modal-body">
                <form action="/edit_document/{{ $documents->id }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>File Name</label>
                            <input type="text" class="form-control @error('filename') is-invalid @enderror" name="filename" value="{{$documents->filename}}">
                            @error('filename')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File Description</label>
                            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Enter ...">{{ $documents->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-info float-right">Edit document</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div><!-- /.row -->
@endsection
    
@section('scripts')

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
<script src="{{ asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
@endsection