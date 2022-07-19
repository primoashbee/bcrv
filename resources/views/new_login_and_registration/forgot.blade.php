<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ url('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!--CSS Files-->
    <link href="{{ url('../admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('../admin_assets/css/now-ui-dashboard.css?v=1.5.0') }}" rel="stylesheet" />
    <!--CSS Just for demo purpose, don't include it in your project-->
    <link href="{{ url('../admin_assets/demo/demo.css') }}" rel="stylesheet" />
    {{-- Main css --}}
    <link rel="stylesheet" href="{{ asset('reset_assets/style.css') }}">
</head>
<style>
.wrapper .field .btn-2 {
    background: rgb(255, 230, 3);
    color: #333;
}
.heading span {
  background: rgb(255, 230, 3);
  color: #333;
}
</style>
<body>
        <form action="{{ url('forgot_password') }}" method="POST">
        {{ csrf_field() }}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div> 
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div> 
        @endif
        <div class="heading">
            <h3>Please enter your <span> email </span> address, <br>
                an email will be sent to you for your account recovery.</h3>
        </div>
        <div class="wrapper">
            <div class="field">
                
                <input type="email" id="email" name="email" placeholder="Email Address">
                <button type="submit" class="btn-2">Submit</button>
            </div>
        </div>
    </form>
</body>
</html>