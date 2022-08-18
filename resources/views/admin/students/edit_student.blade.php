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
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="school_year">Year</label>
                                    <select  class="custom-select form-control" id="school_year" name="school_year">
                                        @foreach($years as $year)
                                        <option value="{{$year}}"> {{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="batch">Batch</label>
                                    <select class="custom-select form-control" id="batch" name="batch">
                                        @foreach($batches as $batch)
                                        <option value="{{$batch}}"> {{$batch}}</option>
                                        @endforeach
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
<script>
    $(function(){
        $("#batch").val(@json($students->batch))
        $("#school_year").val(@json($students->school_year))
    })
</script>
@endsection