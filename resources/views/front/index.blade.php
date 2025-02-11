@extends('layouts.app')
@section('page_title', 'Home')
@section('main_content')

    <!-- header section start -->
    <div class="header_section" style="background-image: url('images/banner-bg.png');">
        <div class="header_main">
            <div class="container-fluid">

                @include('layouts.navigation')

                <!-- END nav -->
            </div>
        </div>

        <!-- header section end -->

        <!-- banner section start -->
        <div class="banner_section layout_padding">
            <div class="container">
                <h1 class="discover_text">Discover</h1>
                <h1 class="amazing_text">Your Amazing Place</h1>
                <p class="find_text">Find great places to hangout , working, food , shop , & visit from local experts</p>
                <form method="get" action="{{ route('search') }}">

                    <div class="banner_section2">
                        <div class="row">
                            <div class="col-md-6">

                                    <div class="form-group">
                                        <input type="text" name="query" class="search form-control" id="query" placeholder="Find a place..">

                                        <!-- Input Hidden untuk Latitude dan Longitude -->
                                        <input type="hidden" id="latitude" name="latitude">
                                        <input type="hidden" id="longitude" name="longitude">

                                    </div>

                            </div>
                            <div class="col-md-6">

                                    <div class="form-group">
                                        <select name="category" class="form-control" id="">
                                            <option value="">Category (optional)</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->name }}">{{ \Illuminate\Support\Str::headline($category->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                            </div>
                        </div>
                        <div class="start_bt">
                            <div class="Search_bt">
                                <button type="submit">Search</button>
                            </div>
                        </div>
                        <h2 class="browse_text">Browse the highlight</h2>
                    </div>
                </form>
                <div class="icons_main">
                    @forelse($highlightCategories as $category)
                        <a href="{{ route('category.details', $category->slug) }}">
                            <div class="box_1">
                                <div class="icon_1" style="background-image: url({{ asset('storage/'.$category->icon) }});">
                                    <h6 class="food_text">{{ \Illuminate\Support\Str::headline($category->name) }}</h6>
                                </div>
                            </div>
                        </a>
                    @empty
                        <small>No highlighted categories yet </small>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>

    <!-- popular section start -->
    <section class="ftco-section ftco-destination">
        <div class="container">
            <div class="row justify-content-start mb-3 pb-3">
                <div class="col-md-7 heading-section ftco-animate ">
                    <span class="subheading">Featured</span>
                    <h2 class="mb-4"><strong>Featured</strong> Places</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($sliderEnabled)
                        @livewire('featured-places')
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- popular section end -->

    <!-- editor's choice section start -->
    <section class="editor-picks">
        <div class="cta">
            <!-- Image by https://unsplash.com/@thanni -->
            <div class="cta_background" style="background-image:url(images/cta.jpg)"></div>
            <div class="container">
                <div class="row">
                    <div class="col">

                        <!-- CTA Slider -->

                        <div class="cta_slider_container ftco-animate">
                            <div class="owl-carousel owl-theme cta_slider">

                                <!-- CTA Slider Item -->
                                <div class="owl-item cta_item text-center">
                                    <div class="cta_title">maldives deluxe package</div>
                                    <div class="rating_r rating_r_4">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="cta_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                                        eu convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus
                                        mi hendrerit nec. Proin bibendum, augue faucibus tincidunt ultrices, tortor
                                        augue gravida lectus, et efficitur enim justo vel ligula.</p>
                                    <div class="button cta_button">
                                        <div class="button_bcg"></div>
                                        <a href="place_detail.html">book now<span></span><span></span><span></span></a>
                                    </div>
                                </div>

                                <!-- CTA Slider Item -->
                                <div class="owl-item cta_item text-center">
                                    <div class="cta_title">maldives deluxe package</div>
                                    <div class="rating_r rating_r_4">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="cta_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                                        eu convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus
                                        mi hendrerit nec. Proin bibendum, augue faucibus tincidunt ultrices, tortor
                                        augue gravida lectus, et efficitur enim justo vel ligula.</p>
                                    <div class="button cta_button">
                                        <div class="button_bcg"></div>
                                        <a href="place_detail.html">book now<span></span><span></span><span></span></a>
                                    </div>
                                </div>

                                <!-- CTA Slider Item -->
                                <div class="owl-item cta_item text-center">
                                    <div class="cta_title">maldives deluxe package</div>
                                    <div class="rating_r rating_r_4">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="cta_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                                        eu convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus
                                        mi hendrerit nec. Proin bibendum, augue faucibus tincidunt ultrices, tortor
                                        augue gravida lectus, et efficitur enim justo vel ligula.</p>
                                    <div class="button cta_button">
                                        <div class="button_bcg"></div>
                                        <a href="place_detail.html">book now<span></span><span></span><span></span></a>
                                    </div>
                                </div>

                            </div>

                            <!-- CTA Slider Nav - Prev -->
                            <div class="cta_slider_nav cta_slider_prev">
                                <svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     width="28px" height="33px" viewBox="0 0 28 33" enable-background="new 0 0 28 33"
                                     xml:space="preserve">
                      <defs>
                          <linearGradient id='cta_grad_prev'>
                              <stop offset='0%' stop-color='#fa9e1b'/>
                              <stop offset='100%' stop-color='#8d4fff'/>
                          </linearGradient>
                      </defs>
                                    <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
                      M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
                      C22.545,2,26,5.541,26,9.909V23.091z"/>
                                    <polygon class="nav_arrow" fill="#F3F6F9" points="15.044,22.222 16.377,20.888 12.374,16.885 16.377,12.882 15.044,11.55 9.708,16.885 11.04,18.219
                      11.042,18.219 "/>
                    </svg>
                            </div>

                            <!-- CTA Slider Nav - Next -->
                            <div class="cta_slider_nav cta_slider_next">
                                <svg version="1.1" id="Layer_5" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     width="28px" height="33px" viewBox="0 0 28 33" enable-background="new 0 0 28 33"
                                     xml:space="preserve">
                      <defs>
                          <linearGradient id='cta_grad_next'>
                              <stop offset='0%' stop-color='#fa9e1b'/>
                              <stop offset='100%' stop-color='#8d4fff'/>
                          </linearGradient>
                      </defs>
                                    <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
                    M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
                    C22.545,2,26,5.541,26,9.909V23.091z"/>
                                    <polygon class="nav_arrow" fill="#F3F6F9" points="13.044,11.551 11.71,12.885 15.714,16.888 11.71,20.891 13.044,22.224 18.379,16.888 17.048,15.554
                    17.046,15.554 "/>
                    </svg>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- editor's choice section end -->

    <!--  new here section start -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-start mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate">
                    <span class="subheading">New Comers</span>
                    <h2 class="mb-4"><strong>The New</strong> is Coming</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row new-come-slider owl-carousel ftco-animate" style="touch-action: pan-y;">
                @forelse($newComers as $new)
                    <div class="item col-md-12 ftco-animate">
                        <div class="destination">
                            <a href="{{ route('api.place.details', $new->place_unique_code) }}" class="img img-2 d-flex justify-content-center align-items-center"
                               style="background-image: url({{ asset("storage/{$new->thumbnail}") }});">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="text p-3">
                                <div class="d-flex">
                                    <div class="one">
                                        <h3><a href="{{ route('api.place.details', $new->place_unique_code) }}">{{ $new->name }}</a></h3>
                                        <div class="text-warning star-header">
                                            <span>{{ \App\Helpers\FormatedHelper::starsFormating(isset($new->reviews->rating) ? $new->reviews->rating : null) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <p>{{ $new->address }}</p>
                                <p class="days"><span class="badge badge-warning">{{ \Illuminate\Support\Str::headline($new->category->name) }}</span></p>
                                <hr>
                                <p class="bottom-area d-flex">
                                    <span><i class="icon-map-o"></i> </span>
                                    <span class="ml-auto"><a href="{{ route('api.place.details', $new->place_unique_code) }}">Discover</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <small class="text-center">There is no data available at the moment.</small>
                @endforelse
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <h2 class="mb-4">Some fun facts</h2>
                    <span class="subheading">More than 100,000 places ready for you to explore</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="100000">0</strong>
                                    <span>Happy Customers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="40000">0</strong>
                                    <span>Destination Places</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="87000">0</strong>
                                    <span>Hotels</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="56400">0</strong>
                                    <span>Restaurant</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- new here section end -->

    <!-- should visit section start -->
    <section class="ftco-section ftco-destination should-visit-section">
        <div class="container">
            <div class="row justify-content-start mb-3 pb-3">
                <div class="col-md-7 heading-section ftco-animate ">
                    <span class="subheading">Recommendation</span>
                    <h2 class="mb-4"><strong>You Should Visit</strong> This Destination</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($sliderEnabled)
                        @livewire('you-shoul-visit')
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- should visit section end -->

    <!-- recommedation section start-->
    <section class="recomendation-section mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-7 heading-section ftco-animate ">
                    <span class="subheading">Available</span>
                    <h2 class="mb-4"><strong>Maybe You Like</strong> This Destination</h2>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <!-- Offers Grid -->

                    @if($sliderEnabled)
                        @livewire('maybe-you-like')
                    @endif
                </div>


            </div>
    </section>
    <!-- recomendation section end -->

    <!-- subscribe section start -->
    <section class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                        <h2>Subcribe to our Newsletter</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in</p>
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-md-8">
                                <form action="#" class="subscribe-form">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Enter email address">
                                        <input type="submit" value="Subscribe" class="submit px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe section end -->
@endsection

@section('additional_js')
    <script>
        document.addEventListener('livewire:init', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        document.getElementById('latitude').value = lat
                        document.getElementById('longitude').value = lng

                        Livewire.dispatch('updateLocation', { lat:lat, lng:lng });
                    },
                    (error) => {
                        console.error('Gagal mendapatkan lokasi:', error);
                        alert('Aktifkan lokasi Anda!');
                    }
                );
            } else {
                alert('Browser tidak mendukung Geolocation.');
            }
        });
    </script>



@endsection
