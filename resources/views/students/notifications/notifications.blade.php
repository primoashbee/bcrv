@extends('layouts.master_student')

@section('title')
    Student | Notifications
@endsection

@section('content')
    @foreach ($responses as $response)
        <div class="row">
            <div class="col-12">
            <div class="callout callout-danger">
                <h5><i class="fas fa-info"></i> Request ID: {{ $response->request_id }}</h5>
                Your request for
                <u><span class="text-info text-lg"><strong> {{ $response->file_name }}</strong></span></u>
                have a new update, the admins have provided you their response this
                <u><span class="text-success text-lg"><strong> {{ $response->date_sent }}</strong></span></u>,
                Thank you!
                <br>
                <br>
                <h5><i class="fas fa-info"></i> Date of Request: {{ $response->request_date }}</h5>
            </div>
            </div>
        </div><!-- /.row -->
    @endforeach
@endsection
@section('scripts')
@endsection