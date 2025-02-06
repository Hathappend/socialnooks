<?php

namespace App\Services;

use App\Repositories\AccessibilityRepository;
use Illuminate\Database\Eloquent\Collection;

class AccessibilityService
{
    private AccessibilityRepository $accessibilityRepository;

    public function __construct(AccessibilityRepository $accessibilityRepository)
    {
        $this->accessibilityRepository = $accessibilityRepository;
    }

    public function getAccessibilities(): Collection
    {
        return $this->accessibilityRepository->getAll();
    }

    public function filterColumn(string $column, array $value): Collection
    {
        return $this->accessibilityRepository->filterById($column, $value);
    }
}
