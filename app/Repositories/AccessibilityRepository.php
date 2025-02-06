<?php

namespace App\Repositories;

use App\Models\Accessibility;
use App\Repositories\Contracts\AccessibilityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AccessibilityRepository implements AccessibilityRepositoryInterface
{

    public function getAll(): Collection
    {
        return Accessibility::all();
    }

    public function filterById(string $column, array $params): Collection
    {
        return Accessibility::whereIn($column, $params)->get();
    }
}
