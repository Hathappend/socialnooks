<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApiRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiRepository implements ApiRepositoryInterface
{
    protected String $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google_maps.key');
    }

    /**
     * @throws Exception
     */
    public function search($query,  $category, $latitude, $longitude, $nextPageToken, $radius=1000)
    {
        $url = "https://places.googleapis.com/v1/places:searchText";
        $urlNearby = "https://places.googleapis.com/v1/places:searchNearby";

//        dd($query,  $category, $latitude, $longitude);

        try {

            $data = [];

            if (isset($query) && isset($category)) {
                // Text Search dengan filter kategori
                $params = [
                    'textQuery' => $query,
                    'maxResultCount' => 5,
                    'includedType' => $category, // Gunakan singular untuk text search
                    'locationBias' => [
                        'circle' => [
                            'center' => [
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ],
                            'radius' => $radius,
                        ],
                    ]
                ];

                if ($nextPageToken) {
                    $params['pageToken'] = $nextPageToken;
                }

//                dd($nextPageToken);

                $data = $this->sendSearchRequest($url, $params, 'searchText');

            } elseif (isset($query) && !isset($category)) {
                $params = [
                    'textQuery' => $query,
                    'maxResultCount' => 5,
                    "rankPreference" => "DISTANCE",
                    'locationBias' => [
                        'circle' => [
                            'center' => [
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ],
                            'radius' => $radius,
                        ],
                    ]
                ];

                if ($nextPageToken) {
                    $params['pageToken'] = $nextPageToken;
                }

                $data = $this->sendSearchRequest($url, $params, 'searchText');

            } elseif (empty($query) && isset($category)) {
                $params = [
                    'maxResultCount' => 5,
                    "includedTypes"=> [$category],
                    'locationRestriction' => [
                        'circle' => [
                            'center' => [
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ],
                            'radius' => $radius,
                        ],
                    ]
                ];

                if ($nextPageToken) {
                    $params['pageToken'] = $nextPageToken;
                }

//                dd($params);

                $data = $this->sendSearchRequest($urlNearby, $params, 'nearby');


            }


//            logger()->info('Request Parameters:', $params);

            if (empty($data['places'])) {
                $params = [
                    'maxResultCount' => 5,
                    "includedTypes"=> ['restaurant'],
                    'locationRestriction' => [
                        'circle' => [
                            'center' => [
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ],
                            'radius' => $radius,
                        ],
                    ]
                ];

                if ($nextPageToken) {
                    $params['pageToken'] = $nextPageToken;
                }

                $data = $this->sendSearchRequest($urlNearby, $params, 'nearby');
            }

            $data['places'] = $data['places'] ?? [];

            foreach ( $data['places'] as &$place) {
                if (!empty($place['photos'][0]['name'])) {
                    $photoName = $place['photos'][0]['name'];
                    $place['photoUrl'] = "https://places.googleapis.com/v1/{$photoName}/media?maxHeightPx=720&maxWidthPx=1440&key={$this->apiKey}";
                } else {
                    $place['photoUrl'] = null;
                }

            }



            return $data;
        } catch (ConnectionException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => false,
            ];
        }
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function sendSearchRequest($url, $params, $useFor)
    {
        $fieldMask = '';
        if ($useFor == 'nearby') {
            $fieldMask = 'places.id,places.displayName,places.formattedAddress,places.rating,places.userRatingCount,places.photos,places.priceRange';
        }else{
            $fieldMask = 'places.id,places.displayName,places.formattedAddress,places.rating,places.userRatingCount,places.photos,places.priceRange,nextPageToken';
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Goog-Api-Key' => $this->apiKey,
            'X-Goog-FieldMask' => $fieldMask,
        ])->post($url, $params);

        if ($response->failed()) {
            throw new Exception('Failed to fetch data from Google Maps API.');
        }

        return $response->json();
    }

    public function getPlaceDetail(String $placeId)
    {
        $url = "https://places.googleapis.com/v1/places/$placeId";

        try {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'id,displayName,formattedAddress,location,priceRange,rating,userRatingCount,reviews,regularOpeningHours,internationalPhoneNumber,nationalPhoneNumber,paymentOptions,delivery,dineIn,takeout,reservable,parkingOptions,liveMusic,outdoorSeating,restroom,allowsDogs,goodForChildren,goodForGroups,servesBeer,servesBreakfast,servesBrunch,servesCocktails,servesCoffee,servesDessert,servesDinner,servesLunch,servesVegetarianFood,servesWine,editorialSummary,accessibilityOptions,photos', //
            ])->get($url);

            if ($response->failed()) {
                throw new Exception('Failed to fetch data from Google Maps API.');
            }

            $response = $response->json();

            $photoUrls = [];

            if (isset($response['photos']) && is_array($response['photos'])) {
                foreach ($response['photos'] as &$photo) {
                    if (isset($photo['name'])) {
                        $photoName = $photo['name'];
                        $photoUrls[] = "https://places.googleapis.com/v1/{$photoName}/media?maxHeightPx=720&maxWidthPx=1440&key={$this->apiKey}";
                    }
                }
                $response['photoUrls'] = $photoUrls;
            }else{
                $response['photoUrls'] = [];
            }

            return $response;

        } catch (ConnectionException $e) {
           return [
            'error' => $e->getMessage(),
                'status' => false,
            ];
        }
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function autocomplete($query, $latitude, $longitude, $radius = 5000)
    {

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
            ])->post('https://places.googleapis.com/v1/places:autocomplete', [
                'input' => $query,
                'locationBias' => [
                    'circle' => [
                        'center' => [
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                        ],
                        'radius' => $radius,
                    ],
                ],
            ]);

            if ($response->failed()) {
                throw new Exception('Failed to fetch data from Google Maps API.');
            }

//            dd($response->json());

            return $response->json();
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => false,
            ];
        }
    }

    /**
     * @throws Exception
     */
    public function getLangLngFromByPlaceId(string $placeId)
    {

        try {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'location',
            ])->get("https://places.googleapis.com/v1/places/$placeId");

            if ($response->failed()) {
                throw new Exception('Failed to fetch data from Google Maps API.');
            }

            return $response->json();

        } catch (ConnectionException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => false,
            ];
        }
    }

    /**
     * @throws Exception
     */
    public function getHomeDataPlace($category, $latitude, $longitude, $radius)
    {
        $urlNearby = "https://places.googleapis.com/v1/places:searchNearby";

        try {

            $params = [
                'maxResultCount' => 5,
                "includedTypes"=> ['restaurant'],
                'locationRestriction' => [
                    'circle' => [
                        'center' => [
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                        ],
                        'radius' => $radius,
                    ],
                ]
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'places.id,places.displayName,places.formattedAddress,places.shortFormattedAddress,places.adrFormatAddress,places.rating,places.photos',
            ])->post($urlNearby, $params);

            if ($response->failed()) {
                throw new Exception('Failed to fetch data from Google Maps API.');
            }

            $data = $response->json();

            foreach ($data['places'] as &$place) {
                if (isset($place['photos'][0]['name'])) {
                    $photoName = $place['photos'][0]['name'];
                    $place['photoUrl'] = "https://places.googleapis.com/v1/{$photoName}/media?maxHeightPx=720&maxWidthPx=1440&key={$this->apiKey}";
                } else {
                    $place['photoUrl'] = null;
                }
            }

            return $data;

        } catch (ConnectionException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => false,
            ];
        }
    }


}
