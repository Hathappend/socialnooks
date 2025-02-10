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
        <p class="title">Confirm Password</p>
        <span class="subtitle">This is a secure area of the application. Please confirm your password before continuing.</span>
    </div>

    <form class="form" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <input type="password" name="password" autocomplete="current-password" class="input" placeholder="Password">
        @error("password")
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button class="form-btn">Confirm</button>
    </form>
</div>

</body>
</html>
