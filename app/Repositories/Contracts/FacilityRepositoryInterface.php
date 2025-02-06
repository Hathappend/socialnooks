<?php

namespace App\Repositories\Contracts;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Collection;

interface FacilityRepositoryInterface
{
    public function getAll(): Collection;

    public function filterById(string $column, array $params): Collection;
}
