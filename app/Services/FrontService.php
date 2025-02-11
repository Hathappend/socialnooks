<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Setting;
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
        $highlightCategories = $this->categoryRepository->findCategoriesByHighlight();
        $sliderEnabled = boolval(Setting::where('name', 'Slider Carousel')->value('condition') ?? false);


        return compact('categories', 'newComers', 'highlightCategories', 'sliderEnabled');
    }

}
