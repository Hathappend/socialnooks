<?php

namespace App\Services;

use App\Repositories\FacilityRepository;
use Illuminate\Database\Eloquent\Collection;

class FacilityService
{
    private FacilityRepository $facilityRepository;

    public function __construct(FacilityRepository $facilityRepository)
    {
        $this->facilityRepository = $facilityRepository;
    }

    public function getFacilities(): Collection
    {
        return $this->facilityRepository->getAll();
    }

    public function filterColumn(string $column, array $value): Collection
    {
        return $this->facilityRepository->filterById($column, $value);
    }
}
