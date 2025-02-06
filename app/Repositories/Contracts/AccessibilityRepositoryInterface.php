<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface AccessibilityRepositoryInterface
{
    public function getAll(): Collection;
}
