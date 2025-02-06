@extends('layouts.app')
@section('page_title', 'Search Result for ' . \Illuminate\Support\Str::upper($searchQuery))
@section('main_content')
    <!-- recommedation section start-->
    <section class="ftco-section recomendation-section mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-12 heading-section ftco-animate">
                    <span class="subheading">Available</span>
                    <h2><strong>Search Result For: </strong> {{ \Illuminate\Support\Str::headline($searchQuery) }}</h2>
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
                    'searchQuery' => $searchQuery,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'category' => $category
                    ])
                </div>

            </div>
        </div>
    </section>
    <!-- recomendation section end -->

@endsection
@section('additional_js')
    <script src="{{ asset('js/filtering.js') }}"></script>
@endsection
