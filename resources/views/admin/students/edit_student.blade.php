@extends('layouts.master')

@section('title')
    Admin | Students - Edit
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
                <form action="/edit_student/{{ $students->id }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Course</label>
                                    <select name="course" class="form-control select2" style="width: 100%; height: 100%;">
                                        <option selected value="{{ $students->course }}">{{ $students->course }}</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleSelectBorder">Year</label>
                                    <select name="year" class="custom-select form-control-border" id="exampleSelectBorder">
                                    <option selected value="{{ $students->year }}">{{ $students->year }}</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    <option value="5th Year">5th Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleSelectBorder">Status</label>
                                    <select name="status" class="custom-select form-control-border" id="exampleSelectBorder">
                                    <option selected value="{{ $students->status }}">{{ $students->status }}</option>
                                    <option value="1">1 - Active</option>
                                    <option value="0">0 - Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-info float-right">Edit Student</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div><!-- /.row -->
@endsection
    
@section('scripts')
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.js') }}"></script>
@endsection