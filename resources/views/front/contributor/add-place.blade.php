@extends('layouts.app')
@section('page_title', 'Add Place')
@section('additional_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/add-place.css') }}" rel="stylesheet">
@endsection
@section('main_content')
    <div class="container">
        @livewire('multi-option')
    </div>
    <script>
        function updateStepIndicator(step) {
            document.querySelectorAll('.step-indicator span').forEach(el => el.classList.remove('active'));
            document.getElementById(`step${step}-indicator`).classList.add('active');
        }

        function nextStep(step) {
            document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));
            setTimeout(() => {
                document.getElementById(`step${step}`).classList.add('active');
            }, 300);
            updateStepIndicator(step);
        }

        function prevStep(step) {
            document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));
            setTimeout(() => {
                document.getElementById(`step${step}`).classList.add('active');
            }, 300);
            updateStepIndicator(step);
        }

        function finishStep() {
            alert("Wizard Completed!");
        }

        function filterOptions(containerId, inputElement) {
            let filter = inputElement.value.toLowerCase();
            let container = document.getElementById(containerId);
            let options = container.querySelectorAll("label");

            options.forEach(label => {
                let text = label.textContent.toLowerCase();
                label.style.display = text.includes(filter) ? "inline-block" : "none";
            });
        }


    </script>
@endsection
@section('additional_js')
    <script>
        document.addEventListener('livewire:init', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        let lat = position.coords.latitude;
                        let lon = position.coords.longitude;

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;

                        Livewire.dispatch('setUserCurrentLocation', { lat: lat, lng: lon });


                    },
                    (error) => {
                        console.error('Gagal mendapatkan lokasi:', error);
                        alert('Aktifkan lokasi Anda untuk menggunakan fitur ini.');
                    }
                );
            } else {
                alert('Browser Anda tidak mendukung Geolocation.');
            }
        });

    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&loading=async&libraries=marker&v=weekly"
    defer
    ></script>
    <script>
        {{--let map, marker;--}}

        {{--document.addEventListener("location-updated", (event) => {--}}
        {{--    if (!event.detail?.detail) return;--}}

        {{--    const newLat = parseFloat(event.detail.detail.latitude);--}}
        {{--    const newLng = parseFloat(event.detail.detail.longitude);--}}

        {{--    if (isNaN(newLat) || isNaN(newLng)) return;--}}

        {{--    if (!map) {--}}
        {{--        initializeMap(newLat, newLng);--}}
        {{--    } else {--}}
        {{--        updateMapPosition(newLat, newLng);--}}
        {{--    }--}}
        {{--});--}}

        {{--function initializeMap(lat, lng) {--}}
        {{--    const position = { lat, lng };--}}

        {{--    map = new google.maps.Map(document.getElementById("map"), {--}}
        {{--        zoom: 17,--}}
        {{--        center: position,--}}
        {{--        mapId: "{{ config('services.google_maps.map_id') }}",--}}
        {{--        fullscreenControl: false--}}
        {{--    });--}}

        {{--    if (window.google?.maps?.marker?.AdvancedMarkerElement) {--}}
        {{--        marker = new google.maps.marker.AdvancedMarkerElement({--}}
        {{--            map,--}}
        {{--            position,--}}
        {{--            gmpDraggable: true // Enable dragging--}}
        {{--        });--}}

        {{--        // Event saat marker selesai digeser--}}
        {{--        marker.addListener('dragend', (event) => {--}}
        {{--            const newPos = event.latLng;--}}
        {{--            const newLat = newPos.lat();--}}
        {{--            const newLng = newPos.lng();--}}

        {{--            // Update ke Livewire--}}
        {{--            Livewire.dispatch('setUserCurrentLocation', { lat: newLat, lng: newLng });--}}
        {{--        });--}}

        {{--        // Event klik--}}
        {{--        // marker.addListener('click', () => {--}}
        {{--        //     alert("Marker diklik!");--}}
        {{--        // });--}}
        {{--    }--}}
        {{--}--}}

        {{--function updateMapPosition(lat, lng) {--}}
        {{--    const newPos = new google.maps.LatLng(lat, lng);--}}
        {{--    map.panTo(newPos);--}}
        {{--    marker.position = newPos;--}}
        {{--}--}}

        {{--// Untuk inisialisasi awal--}}
        {{--window.initMap = function() {--}}
        {{--    console.log("Maps loaded");--}}
        {{--};--}}

    </script>

    <script>
        // Variabel terpisah untuk setiap map
        let map1, map2;
        let marker1, marker2;

        // Fungsi inisialisasi untuk map pertama
        function initializeMap1(lat, lng) {
            const position = { lat, lng };

            map1 = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: position,
                mapId: "{{ config('services.google_maps.map_id') }}",
                fullscreenControl: false
            });

            if (window.google?.maps?.marker?.AdvancedMarkerElement) {
                marker1 = new google.maps.marker.AdvancedMarkerElement({
                    map: map1,
                    position: position,
                    gmpDraggable: true
                });

                marker1.addListener('dragend', (event) => {
                    const newPos = event.latLng;
                    Livewire.dispatch('setUserCurrentLocation', {
                        lat: newPos.lat(),
                        lng: newPos.lng()
                    });
                });
            }
        }

        // Fungsi inisialisasi untuk map kedua
        function initializeMap2(lat, lng) {
            const position = { lat, lng };

            map2 = new google.maps.Map(document.getElementById("map-overview"), {
                zoom: 17,
                center: position,
                mapId: "{{ config('services.google_maps.map_id') }}",
                gestureHandling: 'none', // Blok semua gesture (scroll, drag)
                draggable: false, // Blok drag dengan mouse
                zoomControl: false, // Sembunyikan kontrol zoom
                disableDoubleClickZoom: true, // Blok zoom double click
                scrollwheel: false // Blok scroll wheel

            });

            if (window.google?.maps?.marker?.AdvancedMarkerElement) {
                marker2 = new google.maps.marker.AdvancedMarkerElement({
                    map: map2,
                    position: position,
                });
            }
        }

        // Event listener untuk kedua map
        document.addEventListener("location-updated", (event) => {
            if (!event.detail?.detail) return;

            const newLat = parseFloat(event.detail.detail.latitude);
            const newLng = parseFloat(event.detail.detail.longitude);

            if (isNaN(newLat) || isNaN(newLng)) return;

            // Update kedua map
            if (!map1) initializeMap1(newLat, newLng);
            else updateMapPosition(map1, marker1, newLat, newLng);

            if (!map2) initializeMap2(newLat, newLng);
            else updateMapPosition(map2, marker2, newLat, newLng);
        });

        // Fungsi update posisi umum
        function updateMapPosition(mapInstance, markerInstance, lat, lng) {
            const newPos = new google.maps.LatLng(lat, lng);
            mapInstance.panTo(newPos);
            if(markerInstance) markerInstance.position = newPos;
        }

        // Inisialisasi saat API siap
        window.initMap = function() {
            console.log("Maps loaded");
            // Jika perlu inisialisasi awal
            // initializeMap1(defaultLat, defaultLng);
            // initializeMap2(defaultLat, defaultLng);
        };
    </script>

@endsection
