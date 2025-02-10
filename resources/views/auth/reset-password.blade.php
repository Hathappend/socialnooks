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
        <p class="title">Reset Password</p>
        <span class="subtitle">Set a new password and continue your journey with us. 🚀</span>
    </div>

    <form class="form" method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <input type="email" name="email" value="{{old('email', $request->email)}}" class="input" placeholder="Email" autofocus autocomplete="username">
        @error("email")
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <input type="password" name="password" autocomplete="new-password" class="input" placeholder="Password">
        @error("password")
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <input type="password" name="password_confirmation" autocomplete="new-password" class="input" placeholder="Confirm Password">
        @error("password_confirmation")
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <button class="form-btn">Reset Password</button>
    </form>
</div>

</body>
</html>
