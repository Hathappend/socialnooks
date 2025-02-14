<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>


<div class="form-container">
    <div class="title_container">
        <p class="title">Verify Email</p>
        <span class="subtitle">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</span>
    </div>

    @if (session('status') == 'verification-link-sent')
        <small class="text-success">A new verification link has been sent to the email address you provided during registration.</small>
    @endif

    <form class="form" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="form-btn">Resend Verification Email</button>
    </form>

    <form class="form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="form-btn" style="background-color: red">Logout</button>
    </form>

</div>

</body>
</html>
