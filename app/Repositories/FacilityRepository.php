<?php

namespace App\Repositories;

use App\Models\Facility;
use App\Repositories\Contracts\FacilityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FacilityRepository implements FacilityRepositoryInterface
{
    public function getAll(): Collection
    {
        return Facility::all();
    }

    public function filterById(string $column, array $params): Collection
    {
        return Facility::whereIn($column, $params)->get();
    }

}
