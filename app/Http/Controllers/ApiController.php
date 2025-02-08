<?php

namespace App\Http\Controllers;

use App\Helpers\FormatedHelper;
use App\Models\Place;
use App\Services\ApiServices;
use App\Services\CategoryService;
use App\Services\FacilityService;
use App\Services\PaymentService;
use App\Services\PlaceService;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Mockery\Exception;
use Symfony\Component\Uid\Ulid;

class ApiController extends Controller
{
    private ApiServices $apiServices;
    private PlaceService $placeService;
    private FacilityService $facilityService;
    private ServiceService $serviceService;
    private PaymentService $paymentService;


    public function __construct(ApiServices $apiServices,
                                PlaceService $placeService,
                                FacilityService $facilityService,
                                ServiceService $serviceService,
                                PaymentService $paymentService){
        $this->apiServices = $apiServices;
        $this->placeService = $placeService;
        $this->facilityService = $facilityService;
        $this->serviceService = $serviceService;
        $this->paymentService = $paymentService;
    }

    public function searchPlaces(Request $request) : \Illuminate\Http\JsonResponse|View
    {
        $searchQuery = $request->get('query');
        $latitude = $request->get('latitude') ?? null;
        $longitude = $request->get('longitude') ?? null;
        $category = $request->get('category') ?? null;

        return view('front.search', compact('searchQuery', 'latitude', 'longitude', 'category'));
    }

    public function placeDetails(String $placeId): View
    {
        session(['url.intended' => url()->current()]);

        $existsInDatabase = $this->placeService->getPlaceFromCode($placeId);

        if ($existsInDatabase && isset($existsInDatabase['user_id'])) {

            $photos = $existsInDatabase->photos;
            $facilities = $existsInDatabase->facilities;
            $services = $existsInDatabase->services;
            $payments = $existsInDatabase->payments;
            $accessibilities = $existsInDatabase->accessibilities;
            $openingHours = $existsInDatabase->operationalTimes;
            $reviews = $existsInDatabase->reviews()->with(['user','photos'])->get();

            $details = $existsInDatabase->toArray();

            $details['priceRange']['startPrice']['units'] = $details['start_price'];
            $details['priceRange']['endPrice']['units'] = $details['end_price'];
            $details['rating'] = $reviews->avg('rating') ?? 0.0;
            $details['userRatingCount'] = $reviews->count();
            $details['reviews'] = $reviews->toArray();

            $details = FormatedHelper::ratingFormating($details);

            $details = FormatedHelper::priceRangeFormating($details);

            return view('front.place-detail-database', compact('details', 'photos', 'facilities', 'services', 'payments', 'accessibilities', 'openingHours'));

        }
        else{

            try {
                $details = $this->apiServices->getPlaceDetail($placeId);

                $details = FormatedHelper::priceRangeFormating($details);
                $details = FormatedHelper::ratingFormating($details);
                $details = FormatedHelper::placeKeysFormatting($details);

                $facilitiesDb = $this->facilityService->getFacilities()->toArray();
                $servicesDb = $this->serviceService->getServices()->toArray();
                $paymentsDb = $this->paymentService->getPayments()->toArray();

                return view('front.place-detail-api', compact('details', 'facilitiesDb', 'servicesDb','paymentsDb'));
            } catch (\Exception $exception) {

                abort(404, 'Not Found');
            }

        }

    }

    public function autocomplete(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = $request->input('query');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');



        if (!$latitude || !$longitude) {
            return response()->json(['error' => 'Latitude dan Longitude diperlukan'], 400);
        }

        try {

            $suggestions = $this->apiServices->getAutocompleteSuggestions($query, $latitude, $longitude);

            return response()->json($suggestions);

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return response()->json(['error' => $error], 400);
        }
    }

}
