<?php

namespace App\Repositories;

use App\Models\Review;
use App\Models\ReviewPhoto;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{


    public function save(array $data): Review
    {
        return Review::create($data);
    }

    public function findReviewByUserIdAndPlaceCode(int $userId, int $placeId): ?Review
    {
        return Review::where('place_id', $placeId)
            ->where('user_id', $userId)
            ->first();
    }

    public function findReviewById(int $id): ?Review
    {
        return Review::with('photos')->find($id);
    }

    public function deleteById(int $id): bool
    {
        return Review::destroy($id);
    }

    public function deleteByReviewIdAndPhoto(int $reviewId, string $photo): bool
    {
        return ReviewPhoto::where('review_id', $reviewId)
            ->where('photo', $photo)
            ->delete();
    }


    public function update(Review $review, array $data): bool
    {
        return $review->update($data);
    }


}
