<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::whereNotNull('thumbnail')->get();
    }

    public function findById(int $id): ?Category
    {
        return Category::query()->find($id);
    }

    public function findCategoriesByHighlight(bool $highlight = true): Collection
    {
        return Category::where('highlight', $highlight)->get();
    }


}
