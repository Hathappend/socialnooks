<?php

namespace App\Repositories\Contracts;

use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;

interface PlaceRepositoryInterface
{
    public function save(array $place): Place;

    public function findCode(string $placeCode): ?Place;

    public function findAll(): Collection;
}
