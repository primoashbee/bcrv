@extends('layouts.master')

@section('title')
    Admin | Notifications
@endsection

@section('content')
    @foreach ($requests as $request)
        <div class="row">
            <div class="col-12">
            <div class="callout callout-danger">
                <h5><i class="fas fa-info"></i> Request ID: {{ $request->id }}</h5>
                You have received a request from student number
                <u><span class="text-info text-lg"><strong> {{ $request->student_id }}</strong></span></u>
                with the requested file 
                <u><span class="text-success text-lg"><strong> {{ $request->document_name }}</strong></span></u>,
                and the number of copies requested is 
                <u><span class="text-success text-lg"><strong> {{ $request->number_of_copies }}</strong></span></u>
                <br>
                <br>
                <h5><i class="fas fa-info"></i> Date of Request {{ $request->date_of_request }}</h5>
            </div>
            </div>
        </div><!-- /.row -->
    @endforeach
@endsection
@section('scripts')
@endsection