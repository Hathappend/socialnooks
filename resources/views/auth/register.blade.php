
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
        <p class="title">Welcome</p>
        <span class="subtitle">Get started with our app, just create an account and enjoy the experience. 🚀</span>
    </div>

    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" class="input" placeholder="Full Name" autofocus autocomplete="name">
        @error("name")
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <input type="email" name="email" value="{{old('email')}}" class="input" placeholder="Email" autofocus autocomplete="username">
        @error("email")
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <input type="password" name="password" autocomplete="new-password" class="input" placeholder="Password">
        @error("password")
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <input type="password" name="password_confirmation" autocomplete="new-password" class="input" placeholder="Password Confirmation">
        @error("password_confirmation")
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button class="form-btn">Register</button>
    </form>
    <p class="sign-up-label">
        Already registered?
        <a href="{{ route('login') }}">
            <span class="sign-up-link">Login</span>
        </a>

    </p>
</div>

</body>
</html>

