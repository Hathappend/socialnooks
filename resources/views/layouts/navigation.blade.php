<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar {{ \Illuminate\Support\Facades\Route::is('api.place.details') ? 'scrolled awake' : ''  }} bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('front.index')  }}">SocialNooks.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('front.index')  }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link">Category</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item mr-2 cta"><a href="{{ route('contrib.place.add') }}" class="nav-link"><span><i class="fa-solid fa-plus mr-2"></i>Add Place</span></a></li>
                    <li class="nav-item cta"><a href="contact.html" class="nav-link"><span><i class="fa-solid fa-user mr-1"></i> Profile</span></a></li>
                @else
                    <li class="nav-item  mr-2 cta"><a href="{{ route('login') }}" class="nav-link bg-primary"><span><i class="fa-solid fa-user mr-2"></i>Login</span></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
