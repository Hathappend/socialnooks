<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- site metas -->
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page_title')</title>

        @if(! \Illuminate\Support\Facades\Route::is('contrib.place.add') || ! \Illuminate\Support\Facades\Route::is('profile.index'))
            <!-- bootstrap css -->
            <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        @endif


        <!-- style css -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- Responsive-->
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <!-- icon -->
        <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />
        <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
        <!-- Tweaks for older IEs-->
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <!-- owl stylesheets -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
        <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">

        @yield('additional_css')
        @livewireStyles


        <!-- Scripts -->
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    </head>
    <body class="antialiased">
    @php
        use Illuminate\Support\Facades\Route;
    @endphp

    @if(Route::is('contrib.place.add') || Route::is('profile.index'))

    @elseif(! Route::is('front.index', 'api.place.details'))
        @include('layouts.navigation')
        @include('layouts.banner')
    @else
        @include('layouts.header')
    @endif




        @yield('main_content')

        @include('layouts.bottom_nav')

        @if(! Route::is('profile.index'))

        @include('layouts.footer')
        @endif

    @livewireScripts
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/aos.js') }}"></script>
        <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
        <script src="{{ asset('js/scrollax.min.js') }}"></script>
        <script src="{{ asset('js/range.js') }}"></script>
{{--        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>--}}
{{--        <script src="{{ asset('js/google-map.js') }}"></script>--}}
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @if(!\Illuminate\Support\Facades\Route::is('api.place.details'))
            <script src="{{ asset('js/scroll-window.js') }}"></script>
        @endif
        <script src="https://kit.fontawesome.com/838af0168b.js" crossorigin="anonymous"></script>

        @yield('additional_js')

        <script>
            const navItems = document.querySelectorAll('.bottom-nav .nav-item');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    navItems.forEach(item => {
                        item.classList.remove('active');
                    });

                    // Add active class to clicked item
                    this.classList.add('active');

                    const glow = document.createElement('span');
                    glow.classList.add('glow');

                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left - 25;
                    const y = e.clientY - rect.top - 25;

                    glow.style.left = x + 'px';
                    glow.style.top = y + 'px';

                    this.appendChild(glow);

                    setTimeout(() => {
                        glow.remove();
                    }, 1000);
                });
            });
        </script>
    </body>
</html>
