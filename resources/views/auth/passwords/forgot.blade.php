<h1>
    Hello {{ $user->name }}
</h1>
<p>
    You have requested to reset your password.
</p>

<p>
    Please click the link below to reset your password.
    <a href="{{ route('reset_password/'.$user->email.'/'.$code) }}">Reset Password</a>
</p>

