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
                        <span>Browse <strong>183,409</strong> Different Category</span>
                    </i>
                </div>
            </div>

            <!-- Popular Locations Start -->
            <div class="popular-location ftco-animate">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <div class="location-img">
                                    <img src="images/location1.png" alt="">
                                </div>
                                <div class="location-details">
                                    <p>New York</p>
                                    <a href="detail_category.html" class="location-btn">65 <i class="ti-plus"></i> Location</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <div class="location-img">
                                    <img src="images/location2.png" alt="">
                                </div>
                                <div class="location-details">
                                    <p>Paris</p>
                                    <a href="detail_category.html" class="location-btn">60 <i class="ti-plus"></i> Location</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <div class="location-img">
                                    <img src="images/location3.png" alt="">
                                </div>
                                <div class="location-details">
                                    <p>Rome</p>
                                    <a href="detail_category.html" class="location-btn">50 <i class="ti-plus"></i> Location</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <div class="location-img">
                                    <img src="images/location4.png" alt="">
                                </div>
                                <div class="location-details">
                                    <p>Italy</p>
                                    <a href="detail_category.html" class="location-btn">28 <i class="ti-plus"></i> Location</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <div class="location-img">
                                    <img src="images/location5.png" alt="">
                                </div>
                                <div class="location-details">
                                    <p>Nepal</p>
                                    <a href="detail_category.html" class="location-btn">99 <i class="ti-plus"></i> Location</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <div class="location-img">
                                    <img src="images/location6.png" alt="">
                                </div>
                                <div class="location-details">
                                    <p>indonesia</p>
                                    <a href="detail_category.html" class="location-btn">78 <i class="ti-plus"></i> Location</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Popular Locations End -->

        </div>
    </section>
    <!-- recomendation section end -->
@endsection
