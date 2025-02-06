<div>
    <!-- Grid Tempat -->
    <div class="offers_grid">
        @foreach($places as $place)
            <div class="offers_item moving" data-rating="{{isset($place['rating']) ? (float)$place['rating'] : 0.0}}" data-reviews="{{ isset($place['userRatingCount']) ? (int)$place['userRatingCount'] :  0}}">
                <div class="row">
                    <div class="col-lg-3 col-1680-4">
                        <div class="offers_image_container">
                            <div class="offers_image_background" style="background-image:url({{ $place['source'] ?? '' == 'db' ? asset("storage/places/". isset($place['photoUrl']) ?? 'no_image.jpg') : $place['photoUrl'] ?? asset("storage/places/no_image.jpg")}})"></div>
                            <div class="offer_name"><a href="{{ route('api.place.details', $place['id']) }}">{{$place['displayName']['text']}}</a></div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="offers_content">
                            <div class="offers_price">
                                {!! $place['priceDisplay'] !!}
                            </div>
                            <div class="text-warning" style="font-size: 20px;">
                                <span>{{ \App\Helpers\FormatedHelper::starsFormating($place['rating'] ?? null) }}</span>
                            </div>
                            <p class="offers_text">{{ $place['formattedAddress'] }}</p>
                            <div class="offers_icons">
                                <ul class="offers_icons_list">
                                    <li class="offers_icons_item"><img src="{{ asset('images/post.png') }}" alt=""></li>
                                    <li class="offers_icons_item"><img src="{{ asset('images/compass.png') }}" alt=""></li>
                                    <li class="offers_icons_item"><img src="{{ asset('images/bicycle.png') }}" alt=""></li>
                                    <li class="offers_icons_item"><img src="{{ asset('images/sailboat.png') }}" alt=""></li>
                                </ul>
                            </div>
                            <div class="button book_button"><a href="{{ route('api.place.details', $place['id']) }}">See Now<span></span><span></span><span></span></a></div>
                            <div class="offer_reviews">
                                <div class="offer_reviews_content">
                                    <div class="offer_reviews_title">
                                        {{ $place['ratingDisplay'] ?? null }}
                                    </div>
                                    <div class="offer_reviews_subtitle">{{$place['userRatingCount'] ?? 0}} reviews</div>
                                </div>
                                <div class="offer_reviews_rating text-center">{{$place['rating'] ?? 0.0}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Tombol Paginasi -->
    @if($nextPageToken)
        <div class="pagination_wrapper">
            <button wire:click="loadMore" class="load_more">
                See More
                <div class="button_overlay"></div>
            </button>
        </div>
    @endif
</div>
