<?php

namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use App\Services\PlaceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\Uid\Ulid;

class PlaceController extends Controller
{

    private PlaceService $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }


    public function addPlaceView(Request $request):View
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');


        return view('front.contributor.add-place', compact('latitude', 'longitude'));
    }

    public function createPlace(Request $request): RedirectResponse
    {
        $data = $request->all();

        $place_unique_code = Ulid::generate();
        $data['place_unique_code'] = $place_unique_code;
        $data['operational_hours'] = json_decode($data['operational_hours'], true);
        $data['selected_facilities'] = json_decode($data['selected_facilities'], true);
        $data['selected_services'] = json_decode($data['selected_services'], true);
        $data['selected_payments'] = json_decode($data['selected_payments'], true);
        $data['selected_accessibilities'] = json_decode($data['selected_accessibilities'], true);

        $storedPhotos = [];
        foreach ($data['photos'] as $photo) {

            $fileName = $place_unique_code . '_' . Str::ulid() . '.' . $photo->extension();
            $path = $photo->storeAs('places', $fileName, 'public');

            $storedPhotos[] = ['photo' => $path];
        }

        $data['photos'] = $storedPhotos;

        $result = $this->placeService->create($data);

        if ($result) {
            return redirect()->route('profile.index')->with('success', "Added a new place. Please check the 'Place' section in the navigation. ");
        }
        return redirect()->back()->with('error', "Something went wrong");

    }
}
