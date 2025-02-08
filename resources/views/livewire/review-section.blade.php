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
            @if($hasReview)
                <div class="reviews-list">
                    <div class="review-item">
                        <div class="d-flex align-items-start mt-3">
                            <img src="{{ asset('storage/profiles/'. ($hasReview['user']['photo'] ?? 'user_default.jpg'))}}" alt="User" class="rounded-circle profile-img">
                            <div style="width: 100%;">
                                <div class="name-and-toogle d-flex justify-content-between">
                                    <h6>{{ $hasReview['user']['name'] }}</h6>
                                    <button wire:click="deleteReview({{ $hasReview['id'] }})" class="btn btn-link text-danger p-0">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </button>
                                </div>
                                <div class="rating-and-time d-flex justify-content-between">
                                    <div class="text-warning">{{ \App\Helpers\FormatedHelper::starsFormating($hasReview['rating']) }}</div>
                                    <small>{{ \Carbon\Carbon::parse($hasReview['created_at'])->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        <p>{{ isset($hasReview['text_review']) ? $hasReview['text_review'] : ''}}</p>
                        <div class="review-images">
                            @forelse($hasReview['photos'] ?? [] as $photoIndex => $photo)
                                <img
                                    src="{{ asset("storage/{$photo['photo']}") }}"

                                    class="zoomable-image"
                                    data-photo="{{ asset("storage/{$photo['photo']}") }}"
                                >
                            @empty
                            @endforelse
                        </div>
                        <h5 class="mt-3 text-primary" style="cursor: pointer;" data-toggle="modal" data-target="#editReviewModal"
                            wire:click="$dispatch('editReview', { reviewId: {{ $hasReview['id'] }} })">
                            <i class="fa-solid fa-pen-to-square"></i> Edit your review
                        </h5>

                    </div>
                </div>
            @else

                <button class="btn btn-primary w-100" data-toggle="modal" data-target="#writeReviewModal">Write a Review</button>
            @endif
        @else
            <div class="text-center">
                <p>Want to write a review? <a href="{{ route('login') }}" class="text-primary">Login </a>First</p>
            </div>
        @endif

    </div>
    <div class="separator"></div>
    <div class="reviews-list">

        @if(!empty($details['reviews']) && is_array($details['reviews']))

            @forelse($details['reviews'] ?? [] as $reviewIndex => $review)
                @if($loop->first)
                    <h3>Rating and Review</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dolor ea ipsum labore porro provident quis, repudiandae vel veritatis? Adipisci est eveniet perspiciatis praesentium reiciendis sapiente! Deleniti facilis perspiciatis temporibus!</p>
                @endif

                <div class="review-item">
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('storage/profiles/'. ($review['user']['photo'] ?? 'user_default.jpg'))}}" alt="User" class="rounded-circle profile-img">
                        <div style="width: 100%;">
                            <h6>{{ $review['user']['name'] ?? "" }}</h6>
                            <div class="rating-and-time d-flex justify-content-between">
                                <div class="text-warning">{{ \App\Helpers\FormatedHelper::starsFormating($review['rating']) }}</div>
                                <small>{{ \Carbon\Carbon::parse($review['created_at'] ?? null)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    <p>{{ $review['text_review'] }}</p>
                    <div class="review-images">
                        @forelse($review['photos'] ?? [] as $photoIndex => $photo)
                            <img
                                src="{{ asset("storage/{$photo['photo']}") }}"

                                class="zoomable-image"
                                data-photo="{{ asset("storage/{$photo['photo']}") }}"
                            >
                        @empty
                        @endforelse
                    </div>
                </div>
                <hr>

            @empty
            @endforelse
        @endif

            @if(!empty($detailApiPlace['reviews']) && count($detailApiPlace['reviews']) > 0)
                @foreach($detailApiPlace['reviews'] as $reviewApi)
                    @if(!empty($reviewApi['authorAttribution']) && isset($reviewApi['rating']))
                        <div class="review-item">
                            <div class="d-flex align-items-start">
                                <img src="{{ $reviewApi['authorAttribution']['photoUri'] ?? '' }}"
                                     alt="User"
                                     class="rounded-circle profile-img">
                                <div style="width: 100%;">
                                    <h6>{{ $reviewApi['authorAttribution']['displayName'] ?? 'Google User' }}</h6>
                                    <div class="rating-and-time d-flex justify-content-between">
                                        <div class="text-warning">
                                            {{ \App\Helpers\FormatedHelper::starsFormating($reviewApi['rating']) }}
                                        </div>
                                        <small>
                                            {{ $reviewApi['relativePublishTimeDescription'] ?? '' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($reviewApi['originalText']['text']))
                                <p>{{ $reviewApi['originalText']['text'] }}</p>
                            @endif
                        </div>
                        <hr>
                    @endif
                @endforeach
            @endif


    </div>
    <!-- end review list -->
</div>

<script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('reviewAdded', (review) => {
            var modalElement = document.getElementById('writeReviewModal');


            if (modalElement) {
                modalElement.classList.remove('show');
                modalElement.setAttribute('aria-hidden', 'true');
                modalElement.style.display = 'none';

                var modalBackdrop = document.querySelector('.modal-backdrop');
                if (modalBackdrop) {
                    modalBackdrop.parentNode.removeChild(modalBackdrop);
                }

                document.body.classList.remove('modal-open');
                document.body.style.paddingRight = '';
            }

            var chequebookTab = document.getElementById('chequebook-tab');
            if (chequebookTab) {
                chequebookTab.click();
            }
        });
    });
</script>


