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
        <p class="title">Forgot Password</p>
        <span class="subtitle">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</span>
    </div>

    <form class="form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" value="{{old('email')}}" class="input" placeholder="Email" autofocus autocomplete="username">
        @error("email")
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button class="form-btn">Email Password Reset Link</button>
    </form>
    <p class="sign-up-label">
        Remember your password?
        <a href="{{ route('login') }}">
            <span class="sign-up-link">Login</span>
        </a>

    </p>
</div>

</body>
</html>

