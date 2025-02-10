<?php

namespace App\Services;

use App\Models\Place;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PlaceService
{
    private PlaceRepositoryInterface $placeRepository;
    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function create(array $data, string $params = 'db'): bool
    {

        $saveToPlace = [
            'place_unique_code' => $data['place_unique_code'],
            'name' => $data['name'] ?? null,
            'description' => $data['description'] ?? null,
            'address' => $data['address'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'thumbnail' => $data['photos'][0]['photo'] ?? null,
            'start_price' => $data['start_price'] ?? null,
            'end_price' => $data['end_price'] ?? null,
            'phone_number' => $data['phone_number'] ?? null,
            'category_id' => $data['category'] ?? null,
            $params === "API" ? null : 'user_id' => isset($data['name']) ? Auth::user()->id : null,
            $params !== "API" ? null : 'status' => "approved",
        ];

        $save = $this->placeRepository->save($saveToPlace);

        foreach ($data['selected_facilities'] ?? [] as $facility) {
            $save->facilities()->attach($facility);
        }

        foreach ($data['selected_services'] ?? [] as $service) {
            $save->services()->attach($service);
        }

        foreach ($data['selected_payments'] ?? [] as $payment) {
            $save->payments()->attach($payment);
        }

        foreach ($data['selected_accessibilities'] ?? [] as $accessibility) {
            $save->accessibilities()->attach($accessibility);
        }

        foreach ($data['selected_facilities'] ?? [] as $facility) {
            $save->facilities()->attach($facility);
        }


        $saveToOperationalTime = $save->operationalTimes()->createMany($data['operational_hours'] ?? []);

        $savedToPlacePhoto = $save->photos()->createMany($data['photos'] ?? []);

        if ($savedToPlacePhoto && $saveToOperationalTime) {
            return true;
        }

        return false;
    }

    public function getPlaceFromCode(string $placeCode): ?Place
    {
        return $this->placeRepository->findCode($placeCode);
    }

    public function getPendingPlaceByUserId(int $userId, string $status): ?Collection
    {
        return $this->placeRepository->findStatusPlaceByUserId($userId, $status);
    }

    public function getApprovedPlaceByUserId(int $userId, string $status): ?Collection
    {
        return $this->placeRepository->findStatusPlaceByUserId($userId, $status);
    }

    public function getRejectedPlaceByUserId(int $userId, string $status): ?Collection
    {
        return $this->placeRepository->findStatusPlaceByUserId($userId, $status);
    }


}
