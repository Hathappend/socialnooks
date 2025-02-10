<?php

namespace App\Services;

use App\Models\Place;
use App\Models\Review;
use App\Repositories\PlaceRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    private ReviewRepository $reviewRepository;
    private PlaceRepository $placeRepository;

    public function __construct(ReviewRepository $reviewRepository,
                                PlaceRepository $placeRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->placeRepository = $placeRepository;
    }

    public function create(array $dataReview, array $placeDetail): Review|bool
    {
        $findPlace = $this->placeRepository->findCode($placeDetail['place_unique_code'] ?? $placeDetail['id'] );

        $saveToReview = [
            'rating' => $dataReview['rating'],
            'text_review' => $dataReview['text_review'],
            'user_id' => Auth::user()->id,
        ];

        $photos = json_decode($dataReview['photos'], true);

        if (is_null($findPlace)) {

            $placeDetail = [
                'place_unique_code' => $placeDetail['id'],
            ];

            $saveToPlace = $this->placeRepository->save($placeDetail);
            $saveToReview = $saveToPlace->reviews()->create($saveToReview);

            foreach ($photos as $photo) {
                $saveToReview->photos()->create([
                    'photo' => $photo,
                ]);
            }

            return $save;
        }

        $save = $findPlace->reviews()->create($saveToReview);

        foreach ($photos as $photo) {
            $save->photos()->create([
                'photo' => $photo,
            ]);
        }

        return $save;

    }

    public function update(array $dataReview, int $reviewId): bool
    {
        $findReview = $this->reviewRepository->findReviewById($reviewId);

        $saveToReview = [
            'rating' => $dataReview['rating'],
            'text_review' => $dataReview['text_review'],
        ];

        $photos = json_decode($dataReview['photos'], true);

        $save = $this->reviewRepository->update($findReview, $saveToReview);

        foreach ($photos as $photo) {
            $findReview->photos()->create([
                'photo' => $photo,
            ]);
        }

        return $save;
    }

    public function getReviewByUserIdAndPlaceId(int $userId, int $placeId): Review|bool
    {
        $find = $this->reviewRepository->findReviewByUserIdAndPlaceCode($userId, $placeId);
        if ($find) {
            return $find;
        }

        return false;
    }

    public function getReviewById(int $id): Review|bool
    {
        $find= $this->reviewRepository->findReviewById($id);
        if ($find) {
            return $find;
        }

        return false;
    }

    public function getReviewByUserId(int $userId): Collection
    {
        return $this->reviewRepository->findReviewByUserId($userId);
    }

    public function deletePhoto(int $reviewId, string $photo): bool
    {
        return $this->reviewRepository->deleteByReviewIdAndPhoto($reviewId, $photo);
    }
}
