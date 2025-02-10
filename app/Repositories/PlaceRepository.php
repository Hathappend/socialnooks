<?php

namespace App\Repositories;

use App\Models\Place;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PlaceRepository implements PlaceRepositoryInterface
{

    public function save(array $place): Place
    {
        return Place::create($place);
    }

    public function findCode(string $placeCode): ?Place
    {
        return Place::where('place_unique_code', $placeCode)
            ->where('status', 'approved')
            ->first();
    }

    public function findAll(): Collection
    {
        return Place::with(['category', 'reviews'])
            ->where('status', 'approved')
            ->whereNotNull('user_id')
            ->get();
    }

    public function findStatusPlaceByUserId(int $userId, string $status): ?Collection
    {
        return Place::where('user_id', $userId)
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }


}
