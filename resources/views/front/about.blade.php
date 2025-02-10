@extends('layouts.app')
@section('page_title', 'About')
@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection
@section('main_content')
<section class="ftco-section">
    <div class="container">
        <div class="row d-md-flex">
            <div class="col-md-6 ftco-animate img about-image" style="background-image: url(images/about.jpg);">
            </div>
            <div class="col-md-6 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-whatwedo-tab" data-toggle="pill" href="#v-pills-whatwedo" role="tab" aria-controls="v-pills-whatwedo" aria-selected="true">What we do</a>

                            <a class="nav-link" id="v-pills-mission-tab" data-toggle="pill" href="#v-pills-mission" role="tab" aria-controls="v-pills-mission" aria-selected="false">Our mission</a>

                            <a class="nav-link" id="v-pills-goal-tab" data-toggle="pill" href="#v-pills-goal" role="tab" aria-controls="v-pills-goal" aria-selected="false">Our goal</a>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center">

                        <div class="tab-content ftco-animate" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-whatwedo" role="tabpanel" aria-labelledby="v-pills-whatwedo-tab">
                                <div>
                                    <h2 class="mb-4">Discover the Best Hangout Spots</h2>
                                    <p>We help you find the perfect hangout spots! From cozy cafés to Instagrammable rooftop bars, our platform makes it easy to discover the best places to chill, work, or have fun with friends.</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-mission" role="tabpanel" aria-labelledby="v-pills-mission-tab">
                                <div>
                                    <h2 class="mb-4">Making Every Hangout Memorable</h2>
                                    <p>Misi kami adalah menjadikan setiap momen hangout lebih seru dan berkesan. Dengan rekomendasi tempat terbaik, ulasan jujur, dan fitur pencarian yang mudah, kami ingin memastikan kamu selalu punya tempat asyik untuk bersantai.</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-goal" role="tabpanel" aria-labelledby="v-pills-goal-tab">
                                <div>
                                    <h2 class="mb-4">Helping You Find the Perfect Place</h2>
                                    <p>Kami ingin menciptakan pengalaman mencari tempat nongkrong yang cepat, akurat, dan menyenangkan. Apapun suasana yang kamu cari—nyaman untuk kerja, seru untuk nongkrong bareng teman, atau romantis untuk kencan—kami siap membantumu menemukan yang terbaik.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="py-5 team4">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-7 text-center">
                <h3 class="mb-3">Experienced & Professional Team</h3>
                <h6 class="subtitle">You can relay on our amazing features list and also our customer services will be great experience for you without doubt and in no-time</h6>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- column  -->
            <div class="col-lg-3 mb-4">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="https://assets.vogue.com/photos/5876fe0a8a28e998768824d3/4:3/w_1600%2Cc_limit/david-gandy.jpg" alt="wrapkit" class="img-fluid rounded-circle" />
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="pt-2">
                            <h5 class="mt-4 font-weight-medium mb-0">Tito Muhammad Athoriq</h5>
                            <h6 class="subtitle mb-3">Product Manager</h6>
                            <p>Happiness begins when you stop comparing yourself to others.</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- column  -->

            <!-- column  -->
            <div class="col-lg-3 mb-4">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="https://s3.ap-south-1.amazonaws.com/modelfactory.in/upload/2021/Dec/11/blog_images/63e4f7e8b8605bc45c164fdd7f504778.jpg" alt="wrapkit" class="img-fluid rounded-circle" />
                    </div>
                    <div class="col-md-12 text-center d-flex justify-content-center">
                        <div class="pt-2">
                            <h5 class="mt-4 font-weight-medium mb-0">Dzaky Farras Fauzan</h5>
                            <h6 class="subtitle mb-3">UI/UX</h6>
                            <p>Success is not final, failure is not fatal; keep moving forward.</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- column  -->
            <!-- column  -->
            <div class="col-lg-3 mb-4">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="https://mediaslide-europe.storage.googleapis.com/models1/pictures/2732/6431/profile-1502277379-1a5b58255e7778d1af94127577b7be0d.jpg" alt="wrapkit" class="img-fluid rounded-circle" />
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="pt-2">
                            <h5 class="mt-4 font-weight-medium mb-0">Bambang Firman Fatoni</h5>
                            <h6 class="subtitle mb-3">System Analyst</h6>
                            <p>Your time is limited, so don’t waste it living someone else’s life.</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>

            <!-- column  -->
            <div class="col-lg-3 mb-4">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="https://images.stockcake.com/public/2/5/b/25b212d6-d108-450a-b6d1-d497cbe9d1e2_large/handsome-man-portrait-stockcake.jpg" alt="wrapkit" class="img-fluid rounded-circle" />
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="pt-2">
                            <h5 class="mt-4 font-weight-medium mb-0">Asep Yaman Suryaman</h5>
                            <h6 class="subtitle mb-3">Backend Developer</h6>
                            <p>The only way to do great work is to love what you do.</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- column  -->

            <div class="col-lg-3 mb-4">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="https://www.onefashionstop.com/wp-content/uploads/2021/12/KVC.jpg" alt="wrapkit" class="img-fluid rounded-circle" />
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="pt-2">
                            <h5 class="mt-4 font-weight-medium mb-0">Dendi Ramdhani</h5>
                            <h6 class="subtitle mb-3">Front End Developer</h6>
                            <p>Difficulties in life are intended to make us better, not bitter.</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none d-block px-1"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
        </div>
    </div>
</div>

@endsection
