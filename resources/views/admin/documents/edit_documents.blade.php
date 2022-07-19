@extends('layouts.master')

@section('title')
    Admin | Document - Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            You are about to edit a student
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
                            <label>File Description</label>
                            <textarea class="form-control" name="file_description" rows="3" placeholder="Enter ...">{{ $documents->description }}</textarea>
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
@endsection