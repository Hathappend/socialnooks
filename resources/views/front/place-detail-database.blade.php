@extends('layouts.app')
@section('page_title', '')
@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/place-detail.css') }}">
@endsection
@section('main_content')

    <!-- recommedation section start-->
    <section class="recomendation-section place-detail-section">
        <div class="row no-gutters bg-white" >
            <div class="col-sm-12 col-md-12 col-lg-6 shadow-sm detail-section">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">

                        @forelse($photos as $photo)
                            <div class="swiper-slide">
                                <img src="{{ asset("storage/places/$photo->photo") }}" class=""  alt="">
                                <div class="offer_name"><a href="single_listing.html">{{ $details['name'] }}</a></div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <img src="https://semantic-ui.com/images/wireframe/image.png" class=""  alt="">
                            </div>
                        @endforelse

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="container">

                    <div class="offers_content">

                        <div class="offers_price">{{ $details['priceDisplay']  }}</div>
                        <div class="text-warning" style="font-size: 1.2rem;">
                            <span>{{ \App\Helpers\FormatedHelper::starsFormating($details['rating']) }}</span>
                        </div>
                        <p class="offers_text">{{ $details['description'] }}</p>

                        <div class="offers_icons">
                            <ul class="offers_icons_list">
                                <li class="offers_icons_item"><img src="{{ asset('images/post.png') }}" alt=""></li>
                                <li class="offers_icons_item"><img src="{{ asset('images/compass.png') }}" alt=""></li>
                                <li class="offers_icons_item"><img src="{{ asset('images/bicycle.png') }}" alt=""></li>
                                <li class="offers_icons_item"><img src="{{ asset('images/sailboat.png') }}" alt=""></li>
                            </ul>
                        </div>

                        <!-- <div class="button book_button"><a href="#">book<span></span><span></span><span></span></a></div> -->
                        <div class="offer_reviews" >
                            <div class="offer_reviews_content">
                                <div class="offer_reviews_title">{{ $details['ratingDisplay'] }}</div>
                                <div class="offer_reviews_subtitle">{{ $details['userRatingCount'] }} reviews</div>
                            </div>
                            <div class="offer_reviews_rating text-center">{{ $details['rating'] }}</div>
                        </div>

                        <!-- Tabs Section -->
                        <div class="tabs-container" >
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true" >Detail</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="transactions-tab" data-bs-toggle="tab" data-bs-target="#transactions" type="button" role="tab" aria-controls="transactions" aria-selected="false">Menu List</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="chequebook-tab" data-bs-toggle="tab" data-bs-target="#chequebook" type="button" role="tab" aria-controls="chequebook" aria-selected="false">Review</button>
                                </li>
                            </ul>
                            <div class="divider"></div>
                            <div class="tab-content" id="myTabContent" >
                                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">

                                    <!-- Address Section -->
                                    <div class="info-section mt-5">
                                        <div class="section-header">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <h3>Alamat</h3>
                                        </div>
                                        <div class="content-box">
                                            <p>{{ $details['address'] }}</p>
                                        </div>
                                    </div>

                                    <!-- Facilities Section -->
                                    <div class="info-section" >
                                        <div class="section-header">
                                            <i class="fas fa-concierge-bell"></i>
                                            <h3>Fasilitas</h3>
                                        </div>
                                        <div class="facilities-grid">

                                            @forelse($facilities as $facility)
                                                <div class="facility-item">
                                                    <i class="fas fa-wifi"></i>
                                                    <span>{{$facility->name}}</span>
                                                </div>
                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet facility for now</p>
                                                </div>
                                            @endforelse

                                            <!-- More facilities... -->
                                        </div>
                                    </div>

                                    <!-- Operating Hours Section -->
                                    <div class="info-section" >
                                        <div class="section-header">
                                            <i class="far fa-clock"></i>
                                            <h3>Jam Operasional</h3>
                                        </div>
                                        <div class="content-box">
                                            @forelse($openingHours as $hour)

                                                <p>{{$hour->day . ': '. $hour->start . '-' . $hour->end }}</p>
{{--                                                <p>Sabtu - Minggu: 10:00 - 23:00</p>--}}

                                            @empty
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Contact Section -->
                                    <div class="info-section">
                                        <div class="section-header">
                                            <i class="fas fa-phone-alt"></i>
                                            <h3>Kontak</h3>
                                        </div>
                                        <div class="content-box">
                                            <p>Phone Number: {{ $details['phone_number'] }}</p>
                                        </div>
                                    </div>

                                    <!-- Payment Methods Section -->
                                    <div class="info-section" >
                                        <div class="section-header">
                                            <i class="fas fa-credit-card"></i>
                                            <h3>Metode Pembayaran</h3>
                                        </div>
                                        <div class="facilities-grid">

                                            @forelse($payments as $payment)

                                                <div class="facility-item">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                    <span>{{$payment->name}}</span>
                                                </div>

                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet facility for now</p>
                                                </div>
                                            @endforelse
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fab fa-cc-visa"></i>--}}
{{--                                                <span>Kartu Kredit</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fab fa-cc-mastercard"></i>--}}
{{--                                                <span>Debit Card</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-qrcode"></i>--}}
{{--                                                <span>QRIS</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-wallet"></i>--}}
{{--                                                <span>E-Wallet</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-university"></i>--}}
{{--                                                <span>Bank Transfer</span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>

                                    <!-- Services Section -->
                                    <div class="info-section" >
                                        <div class="section-header">
                                            <i class="fas fa-hand-holding-heart"></i>
                                            <h3>Opsi Layanan</h3>
                                        </div>
                                        <div class="facilities-grid">

                                            @forelse($services as $service)

                                                <div class="facility-item">
                                                    <i class="fas fa-store"></i>
                                                    <span>{{$service->name}}</span>
                                                </div>

                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet services for now</p>
                                                </div>
                                            @endforelse
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-shopping-bag"></i>--}}
{{--                                                <span>Take Away</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-motorcycle"></i>--}}
{{--                                                <span>Delivery</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-calendar-check"></i>--}}
{{--                                                <span>Reservasi</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-users"></i>--}}
{{--                                                <span>Private Event</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-headset"></i>--}}
{{--                                                <span>24/7 Support</span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>

                                    <!-- Accessibility Section -->
                                    <div class="info-section">
                                        <div class="section-header">
                                            <i class="fas fa-universal-access"></i>
                                            <h3>Aksesibilitas</h3>
                                        </div>
                                        <div class="facilities-grid">

                                            @forelse($accessibilities as $accessibility)

                                                <div class="facility-item">
                                                    <i class="fas fa-wheelchair"></i>
                                                    <span>{{ $accessibility->name }}</span>
                                                </div>

                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet accessibility for now</p>
                                                </div>
                                            @endforelse
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-elevator"></i>--}}
{{--                                                <span>Lift</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-restroom"></i>--}}
{{--                                                <span>Toilet Disabilitas</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-parking"></i>--}}
{{--                                                <span>Parkir Disabilitas</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-sign-language"></i>--}}
{{--                                                <span>Staff Bahasa Isyarat</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="facility-item">--}}
{{--                                                <i class="fas fa-braille"></i>--}}
{{--                                                <span>Braille Menu</span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="transactions-tab" >
                                    <h4>Recent Transactions</h4>
                                    <p>Quisque pretium augue non nibh tincidunt, at vestibulum risus suscipit. Duis efficitur purus at sapien vulputate, in mollis purus vehicula.</p>
                                </div>
                                <div class="tab-pane fade" id="chequebook" role="tabpanel" aria-labelledby="chequebook-tab">

                                    <div class="review-section">

                                        <div class="text-center mb-4">
                                            <h1 class="display-4"><b>{{ $details['rating'] }}</b></h1>
                                            <div class="text-warning star-header">
                                                <span>{{ \App\Helpers\FormatedHelper::starsFormating($details['rating']) }}</span>
                                            </div>
                                            <p class="text-muted">based on {{$details['userRatingCount'] }} reviews</p>
                                        </div>

                                        @php
                                        $ratingPercent = \App\Helpers\FormatedHelper::getPercentFromUserRating($details['reviews'])
                                        @endphp

                                        <div class="ratings-breakdown mb-4">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="text-muted mr-3">Excellent</span>
                                                <div class="progress w-100 ms-3">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPercent['excellent']}}%;"></div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="text-muted mr-3">Good</span>
                                                <div class="progress w-100 ms-3">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{$ratingPercent['good']}}%;"></div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="text-muted mr-3">Average</span>
                                                <div class="progress w-100 ms-3">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ratingPercent['average']}}%;"></div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="text-muted mr-3">Below Avg</span>
                                                <div class="progress w-100 ms-3">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$ratingPercent['below_avg']}}%;"></div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <span class="text-muted mr-3">Poor</span>
                                                <div class="progress w-100 ms-3">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: {{$ratingPercent['poor']}}%;"></div>
                                                </div>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                <button class="btn btn-primary w-100" data-toggle="modal" data-target="#writeReviewModal">Write a Review</button>
                                            @else
                                                <div class="text-center">
                                                    <p>Want to write a review? <a href="{{ route('login') }}" class="text-primary">Login </a>First</p>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="separator"></div>
                                        <div class="reviews-list">


                                            @forelse($details['reviews'] ?? [] as $reviewIndex => $review)
                                                <div class="review-item">
                                                    <div class="d-flex align-items-start">
                                                        <img src="{{ $review['user']['photo'] }}" alt="User" class="rounded-circle profile-img">
                                                        <div style="width: 100%;">
                                                            <h6>{{ $review['user']['name'] }}</h6>
                                                            <div class="rating-and-time d-flex justify-content-between">
                                                                <div class="text-warning">{{ \App\Helpers\FormatedHelper::starsFormating($review['rating']) }}</div>
                                                                <small>{{ \Carbon\Carbon::parse($review['created_at'])->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>{{ $review['text_review'] }}</p>
                                                    <div class="review-images">
                                                        @forelse($review['photos'] ?? [] as $photoIndex => $photo)
                                                            <img
                                                                src="{{ asset("storage/reviews/{$photo['photo']}") }}"
                                                                alt="Review {{ $details['name'] }} {{$loop->iteration}}"
                                                                class="zoomable-image"
                                                                data-photo="{{ asset("storage/reviews/{$photo['photo']}") }}"
                                                            >
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <hr>
                                            @empty
                                            @endforelse

                                            <!-- Modal (Hanya Satu Modal untuk Semua Gambar) -->

                                        </div>
                                        <!-- end review list -->
                                    </div>
                                    <!-- end review section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 map-section" >
                <div id="map" style="width: 100%;  height:100% " ></div>
            </div>
            <!-- Modal for Write a Review -->

            @livewire('submit-review')

            <div class="modal fade" id="imageZoomModal" tabindex="-1" aria-labelledby="imageZoomModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img id="zoomedImage" src="" alt="Zoomed Image" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <!--  -->
    </section>
    <!-- recomendation section end -->

@endsection
@section('additional_js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap&v=weekly&libraries=marker"
         defer
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/interactive-stars.js') }}"></script>
    <script>
        window.initMap = function () {
            const position = {
                lat: parseFloat("{{ $details['location']['latitude'] ?? $details['latitude'] }}"),
                lng: parseFloat("{{ $details['location']['longitude'] ?? $details['longitude'] }}")
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: position,
                mapId: "{{ config('services.google_maps.map_id') }}"
            });

            if (google.maps.marker) {
                const marker = new google.maps.marker.AdvancedMarkerElement({
                    map: map,
                    position: position,
                    title: "{{ $details['displayName']['text'] ?? $details['name'] }}"
                });

                // Memastikan marker bisa diklik
                marker.clickable = true;

                // Gunakan google.maps.event.addListener untuk event klik
                google.maps.event.addListener(marker, "click", () => {
                    alert("Marker clicked!");
                });
            } else {
                console.error("Library 'marker' tidak ditemukan.");
            }
        };

    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            grabCursor: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('.nav-link');
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    console.log(`${button.textContent} tab activated`);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const zoomableImages = document.querySelectorAll('.zoomable-image');
            const zoomedImage = document.getElementById('zoomedImage');
            const imageZoomModal = new bootstrap.Modal(document.getElementById('imageZoomModal'));

            zoomableImages.forEach(image => {
                image.addEventListener('click', function () {
                    const photoSrc = this.getAttribute('data-photo');
                    zoomedImage.src = photoSrc;
                    imageZoomModal.show();
                });
            });
        });

    </script>

    <script>
        document.getElementById("uploadPhoto").addEventListener("click", function () {
            document.getElementById("fileInput").click();
        });

        document.getElementById("fileInput").addEventListener("change", function () {
            const fileListContainer = document.getElementById("fileList");
            fileListContainer.innerHTML = "";

            const files = this.files;

            if (files.length > 0) {
                Array.from(files).forEach((file, index) => {
                    const fileItem = document.createElement("div");
                    fileItem.className = "file-item";

                    const fileName = document.createElement("span");
                    fileName.textContent = file.name;

                    const removeBtn = document.createElement("button");
                    removeBtn.textContent = "Remove";
                    removeBtn.className = "remove-btn";
                    removeBtn.addEventListener("click", function () {
                        removeFile(index);
                    });

                    fileItem.appendChild(fileName);
                    fileItem.appendChild(removeBtn);
                    fileListContainer.appendChild(fileItem);
                });
            } else {
                document.getElementById("uploadText").textContent = "Click here to upload";
            }
        });

        // Fungsi untuk menghapus file
        function removeFile(index) {
            const input = document.getElementById("fileInput");
            const dataTransfer = new DataTransfer();

            // Tambahkan semua file kecuali yang dihapus
            Array.from(input.files)
                .forEach((file, i) => {
                    if (i !== index) {
                        dataTransfer.items.add(file);
                    }
                });

            input.files = dataTransfer.files;

            // Trigger event untuk memperbarui tampilan daftar file
            const event = new Event('change');
            input.dispatchEvent(event);
        }

    </script>

    <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('reviewAdded', () => {

                var modalElement = document.getElementById('writeReviewModal');
                var modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                }

                // Aktifkan tab chequebook
                var chequebookTab = new bootstrap.Tab(document.getElementById('chequebook-tab'));
                chequebookTab.show();
            });
        });
    </script>




@endsection
