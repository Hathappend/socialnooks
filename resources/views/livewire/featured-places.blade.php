<div class="destination-slider owl-carousel ftco-animate" wire:ignore x-data="{
        initCarousel() {
            $('.destination-slider').trigger('destroy.owl.carousel');
            $('.destination-slider').owlCarousel({
                autoplay: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 50,
			nav: false,
			dots: false,

			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 1
				},
				1000:{
					items: 2
				}
            });
        }
    }"
     x-init="initCarousel()">

    @foreach($places as $place)
        <div class="item">
            <div class="destination">
                <a href="{{ route('api.place.details', $place['id']) }}" class="img d-flex justify-content-center align-items-center"
                   style="background-image: url({{ asset($place['photoUrl']) }});">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="icon-search2"></span>
                    </div>
                </a>
                <div class="text p-3">
                    <div class="d-flex">
                        <div class="one">
                            <h3><a href="{{ route('api.place.details', $place['id']) }}">{{ $place['displayName']['text'] }}</a></h3>
                            <div class="text-warning star-header">
                                <span>{{ \App\Helpers\FormatedHelper::starsFormating($place['rating']) }}</span>
                            </div>
                        </div>

                    </div>
                    <p>{{ $place['shortFormattedAddress'] }}</p>
                    <p class="days">
                        @if(isset($place['types']))
                            @forelse(array_slice($place['types'], 0, 5) as $type)
                                <span class="badge text-white bg-success" >
                                    <small>{{ \Illuminate\Support\Str::headline($type) }}</small>
                                </span>
                            @empty
                            @endforelse
                        @endif
                    </p>
                    <hr>
                    <p class="bottom-area d-flex">
                        <span><i class="icon-map-o"></i> </span>
                        <span class="ml-auto"><a href="{{ route('api.place.details', $place['id']) }}">Discover</a></span>
                    </p>
                </div>
            </div>
        </div>

    @endforeach
</div>
