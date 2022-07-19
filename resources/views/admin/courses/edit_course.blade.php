@extends('layouts.master')

@section('title')
    Admin | Course - Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            You are about to edit a course
            <a href="/show_courses" type="button" class="btn btn-info bg-info float-right" style="text-decoration: none;">
                <i class="fa fa-arrow-left" style="padding: 10px;"></i> Return
            </a>
            <div class="modal-body">
                <form action="/edit_course/{{ $courses->id }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" name="course_name" class="form-control" value="{{ $courses->course_name }}">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" name="course_description" rows="3">{{ $courses->course_description }}</textarea>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-warning float-right">Edit Course</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div><!-- /.row -->
@endsection
    
@section('scripts')
@endsection