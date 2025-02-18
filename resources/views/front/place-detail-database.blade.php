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
                                <img src="{{ asset("storage/$photo->photo") }}" class=""  alt="">
                                <div class="offer_name"><a href="#">{{ $details['name'] }}</a></div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/places/no_image.jpg') }}" class=""  alt="">
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
                                                    <img src="{{ asset("storage/{$facility->icon}") }}" alt="">
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
                                                    <img src="{{ asset("storage/{$payment->icon}") }}" alt="">
                                                    <span>{{$payment->name}}</span>
                                                </div>

                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet facility for now</p>
                                                </div>
                                            @endforelse

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
                                                    <img src="{{ asset("storage/{$service->icon}") }}" alt="">
                                                    <span>{{$service->name}}</span>
                                                </div>

                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet services for now</p>
                                                </div>
                                            @endforelse

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
                                                    <img src="{{ asset("storage/{$accessibility->icon}") }}" alt="">
                                                    <span>{{ $accessibility->name }}</span>
                                                </div>

                                            @empty
                                                <div class="facility-item">
                                                    <p>Haven't yet accessibility for now</p>
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="transactions-tab" >
                                    <h4>Recent Transactions</h4>
                                    <p>Quisque pretium augue non nibh tincidunt, at vestibulum risus suscipit. Duis efficitur purus at sapien vulputate, in mollis purus vehicula.</p>
                                </div>
                                <div class="tab-pane fade" id="chequebook" role="tabpanel" aria-labelledby="chequebook-tab">

                                    @livewire('review-section', ['details' => $details])
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

            @livewire('submit-review', ['placeDetail' => $details])
            @livewire('edit-review', ['placeDetail' => $details])


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

                marker.clickable = true;

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
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("[data-upload-container]").forEach((container) => {
                const uploadPhotoBtn = container.querySelector(".uploadPhoto");
                const fileInput = container.querySelector(".fileInput");
                const fileListContainer = container.querySelector(".fileList");
                const uploadText = container.querySelector(".uploadText");

                if (uploadPhotoBtn && fileInput) {
                    uploadPhotoBtn.addEventListener("click", function () {
                        fileInput.click();
                    });

                    fileInput.addEventListener("change", function () {
                        fileListContainer.innerHTML = "";

                        const files = fileInput.files;

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
                                    removeFile(fileInput, index);
                                });

                                fileItem.appendChild(fileName);
                                fileItem.appendChild(removeBtn);
                                fileListContainer.appendChild(fileItem);
                            });
                        } else {
                            uploadText.textContent = "Click here to upload (.jpg .png .jpeg)";
                        }
                    });
                }
            });

            function removeFile(input, index) {
                const dataTransfer = new DataTransfer();

                Array.from(input.files).forEach((file, i) => {
                    if (i !== index) {
                        dataTransfer.items.add(file);
                    }
                });

                input.files = dataTransfer.files;

                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    </script>

@endsection
