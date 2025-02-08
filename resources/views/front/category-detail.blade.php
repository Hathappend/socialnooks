@extends('layouts.app')
@section('page_title', $category->name)
@section('main_content')
    <!-- recommedation section start-->
    <section class="ftco-section recomendation-section mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-12 heading-section ftco-animate">
                    <span class="subheading">Available</span>
                    <h2><strong>Find Result By Category: </strong> {{ \Illuminate\Support\Str::headline($category->name) }}</h2>
                </div>
                <div class="col-md-12 d-flex align-items-end">
                    <i class="mb-5">
                        <span>Browse <strong>183,409</strong> Places Nearby You</span>
                    </i>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-11">

                    <!-- Offers Sorting -->
                    <div class="offers_sorting_container">
                        <ul class="offers_sorting">
                            <li>
                                <span class="sorting_text">stars</span>
                                <i class="fa fa-chevron-down"></i>
                                <ul>
                                    <li class="filter_btn" data-filter="*"><span>stars</span></li>
                                    <li class="sort_btn" data-sort-by="stars" data-sort-order="asc"><span>ascending</span></li>
                                    <li class="sort_btn" data-sort-by="stars" data-sort-order="desc"><span>descending</span></li>
                                </ul>
                            </li>
                            <li>
                                <span class="sorting_text">reviews</span>
                                <i class="fa fa-chevron-down"></i>
                                <ul>
                                    <li class="filter_btn" data-filter="*"><span>reviews</span></li>
                                    <li class="sort_btn" data-sort-by="reviews" data-sort-order="asc"><span>ascending</span></li>
                                    <li class="sort_btn" data-sort-by="reviews" data-sort-order="desc"><span>descending</span></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <!-- Offers Grid -->
                    @livewire('search-results', [
                    'searchQuery' => null,
                    'latitude' => null,
                    'longitude' => null,
                    'category' => $category->name
                    ])
                </div>

            </div>
        </div>
    </section>
    <!-- recomendation section end -->

    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">


@endsection
@section('additional_js')
    <script src="{{ asset('js/filtering.js') }}"></script>
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
