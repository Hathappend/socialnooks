@extends('layouts.app')
@section('page_title', 'All Category')
@section('main_content')
    <!-- recommedation section start-->
    <section class="ftco-section recomendation-section mb-5 pb-5">
        <div class="container">

            <div class="row">
                <div class="col-md-12 text-center heading-section ftco-animate ">

                    <h2><strong>Explore an Interesting Category</strong></h2>
                </div>
                <div class="col-md-12 d-flex justify-content-center align-items-center" >
                    <i class="mb-5">
                        <span>Browse <strong>{{ $categories->count() }}</strong> Different Category</span>
                    </i>
                </div>
            </div>

            <!-- Popular Locations Start -->
            <div class="popular-location ftco-animate">
                <div class="container">
                    <div class="row">
                        @forelse($categories as $category)

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-location mb-30">
                                    <div class="location-img">
                                        <img src="{{ asset("storage/{$category->thumbnail}") }}" alt="">
                                    </div>
                                    <div class="location-details">
                                        <p>{{ \Illuminate\Support\Str::headline($category->name) }}</p>
                                        <a href="{{ route('category.details', $category->slug) }}" class="location-btn">{{ $category->places->count() }} <i class="ti-plus"></i> Places</a>
                                    </div>
                                </div>
                            </div>

                        @empty
                        @endforelse
                    </div>

                </div>
            </div>
            <!-- Popular Locations End -->

        </div>
    </section>
    <!-- recomendation section end -->
@endsection
