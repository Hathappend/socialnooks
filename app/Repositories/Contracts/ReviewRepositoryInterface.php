<?php

namespace App\Repositories\Contracts;

use App\Models\Review;

interface ReviewRepositoryInterface
{
    public function save(array $data): Review;

    public function update(Review $review, array $data): bool;

    public function findReviewByUserIdAndPlaceCode(int $userId, int $placeId): ?Review;

    public function findReviewById(int $id): ?Review;

    public function deleteById(int $id): bool;

    public function deleteByReviewIdAndPhoto(int $reviewId, string $photo): bool;
}
