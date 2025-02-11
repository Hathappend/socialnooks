<?php

namespace App\Repositories\Contracts;

interface ApiRepositoryInterface
{
    public function search( $query,  $category, $latitude, $longitude, $nextPageToken, $radius=1000 );

    public function getPlaceDetail(String $placeId);
    public function autocomplete($query, $latitude, $longitude, $radius = 5000);
    public function getHomeDataPlace($categories, $latitude, $longitude, $radius);
}
