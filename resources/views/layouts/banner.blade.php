<!-- banner section start -->
@php
    $path = 'images/bg_2.jpg';
    $text = '';
    if (\Illuminate\Support\Facades\Route::is('category.index')){
        $path = 'images/category_bg.jpg';
        $text = 'Categories';
    }elseif (\Illuminate\Support\Facades\Route::is('search')){
        $text = 'Search Result';
    }
@endphp
<div class="hero-wrap js-fullheight" style="background-image: url({{ asset($path) }});">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('front.index') }}">Home</a></span> <span>Catagory</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ $text }}</h1>
            </div>
        </div>
    </div>
</div>
<!-- banner section end -->
