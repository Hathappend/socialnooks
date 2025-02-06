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

    public function create(array $data): bool
    {

        $saveToPlace = [
            'place_unique_code' => $data['place_unique_code'],
            'name' => $data['name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'thumbnail' => $data['photos'][0]['photo'],
            'start_price' => $data['start_price'],
            'end_price' => $data['end_price'],
            'phone_number' => $data['phone_number'],
            'category_id' => $data['category'],
            'user_id' => Auth::user()->id,
        ];

        $save = $this->placeRepository->save($saveToPlace);

        foreach ($data['selected_facilities'] as $facility) {
            $save->facilities()->attach($facility);
        }

        foreach ($data['selected_services'] as $service) {
            $save->services()->attach($service);
        }

        foreach ($data['selected_payments'] as $payment) {
            $save->payments()->attach($payment);
        }

        foreach ($data['selected_accessibilities'] as $accessibility) {
            $save->accessibilities()->attach($accessibility);
        }

        foreach ($data['selected_facilities'] as $facility) {
            $save->facilities()->attach($facility);
        }

//        dd($data['operational_hours']);


        $saveToOperationalTime = $save->operationalTimes()->createMany($data['operational_hours']);

//        dd($data['photos']);

        $savedToPlacePhoto = $save->photos()->createMany($data['photos']);

        if ($savedToPlacePhoto && $saveToOperationalTime) {
            return true;
        }

        return false;
    }

    public function getPlaceFromCode(string $placeCode): ?Place
    {
        return $this->placeRepository->findCode($placeCode);
    }


}
