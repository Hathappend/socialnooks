<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PlaceRepositoryInterface;

class FrontService
{
    private CategoryRepositoryInterface $categoryRepository;
    private PlaceRepositoryInterface $placeRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, PlaceRepositoryInterface $placeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->placeRepository = $placeRepository;
    }

    public function getFrontPageData(): array
    {
        $categories = $this->categoryRepository->getAll();
        $newComers = $this->placeRepository->findAll();


        return compact('categories', 'newComers');
    }

}
