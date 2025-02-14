<?php

namespace App\Services;

use App\Repositories\Contracts\ApiRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ApiServices
{
    private ApiRepositoryInterface $apiRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(ApiRepositoryInterface $apiRepository, CategoryRepositoryInterface $categoryRepository){
        $this->apiRepository = $apiRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function searchPlaces($query,  $category, $latitude, $longitude, $nextPageToken)
    {

        return $this->apiRepository->search($query,  $category, $latitude, $longitude, $nextPageToken);

    }

    public function getPlaceDetail(String $placeId)
    {
        return Cache::remember($placeId, now()->addDays(30), function () use ($placeId) {
            return $this->apiRepository->getPlaceDetail($placeId);
        });
    }

    public function getAutocompleteSuggestions($query, $latitude, $longitude)
    {
        $cacheKey = "places_autocomplete_{$query}_{$latitude}_{$longitude}";

        return Cache::remember($cacheKey, 60, function () use ($query, $latitude, $longitude) {
            return $this->apiRepository->autocomplete($query, $latitude, $longitude);
        });
    }

    /**
     * @throws \Exception
     */
    public function getLangLngFromByPlaceId(string $placeId)
    {
        return $this->apiRepository->getLangLngFromByPlaceId($placeId);
    }

    public function getHomeDataPlace($latitude, $longitude,$radius, $useFor )
    {
        $categories = $this->categoryRepository->findCategoriesByHighlight()->pluck('name')->toArray();
        $cacheKey = "places_{$useFor}_{$latitude}_$longitude";

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($categories, $latitude, $longitude,$radius) {
            return $this->apiRepository->getHomeDataPlace($categories, $latitude, $longitude, $radius);
        });
    }

}
