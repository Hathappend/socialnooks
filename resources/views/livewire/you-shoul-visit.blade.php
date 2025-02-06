<div wire:ignore class="should-visit-slider owl-carousel ftco-animate">
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
                    <p class="days"><span>2 days 3 nights</span></p>
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
