<h1>Hello {{ $user->name }}</h1>
<p>
    You may click this link to reset your password. 
    <a href="{{ url('reset_password/'.$user->email.'/'.$code) }}">Reset Password</a>
</p>