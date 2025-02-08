<?php

namespace App\Livewire;

use App\Models\Review;
use App\Services\PlaceService;
use App\Services\ReviewService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class ReviewSection extends Component
{

    public array $details = [];
    public $detailApiPlace = [];
    public $hasReview;

    public function mount(array $details){
        $this->detailApiPlace = $details;

//        dd($this->detailApiPlace);

        $this->refreshReviews();
    }
    #[On('updatedReview')]
    #[On('reviewAdded')]
    public function refreshReviews()
    {
        $placeDetail = app(PlaceService::class)->getPlaceFromCode($this->details['place_unique_code'] ?? $this->details['id']);
        if ($placeDetail) {

            $reviews = $placeDetail->reviews()->with(['user','photos'])->get();

            if (Auth::check()) {
                $this->hasReview = app(ReviewService::class)->getReviewByUserIdAndPlaceId(Auth::user()->id, $placeDetail->id);
            }

            $this->details['rating'] = (float)$placeDetail->reviews()->avg('rating') ?? 0.0;
            $this->details['userRatingCount'] = $placeDetail->reviews()->count();
            $this->details['reviews'] = $reviews->isEmpty() ? [] : $reviews->toArray();

        } else {
            $data = [
                'place_unique_code' => $this->details['id'],
                'name' => $this->details['displayName']['text'],
                'status' => "approved",
            ];
            app(PlaceService::class)->create($data, "API");
            $this->hasReview = [];
            $this->details['reviews'] = [];
        }

    }

    public function deleteReview($reviewId)
    {
        $review = app(ReviewService::class)->getReviewById($reviewId);
        if ($review && $review->user_id != auth()->id()) {
            return;
        }

        foreach ($review->photos as $photo) {
            Storage::delete('public/' . $photo->photo);
            $photo->delete();
        }

        $review->delete();

        $this->dispatch('reviewAdded');

    }


    public function render()
    {
        return view('livewire.review-section');
    }
}
