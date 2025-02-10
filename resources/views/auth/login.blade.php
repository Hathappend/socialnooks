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
            <p class="title">Welcome back</p>
            <span class="subtitle">Log in to your account and continue your journey with us. 🚀</span>
        </div>

        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" value="{{old('email')}}" class="input" placeholder="Email" autofocus autocomplete="username">
            @error("email")
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <input type="password" name="password" autocomplete="current-password" class="input" placeholder="Password">
            @error("password")
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <p class="page-link">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        <span class="page-link-label">Forgot Password?</span>
                    </a>
                @endif
            </p>
            <button class="form-btn">Log in</button>
        </form>
        <p class="sign-up-label">
            Don't have an account?
            <a href="{{ route('register') }}">
                <span class="sign-up-link">Sign up</span>
            </a>

        </p>
    </div>

</body>
</html>
