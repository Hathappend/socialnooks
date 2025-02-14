<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchResults extends Component
{

    public ?String $searchQuery = null;
    public $latitude;
    public $longitude;
    public ?String $category = null;
    public array $places = [];
    public ?String $nextPageToken = null;
    public $hasMorePlaces = true;
    public $nextDbPage = null;

    public function mount($searchQuery, $latitude = null, $longitude = null, $category = null): void
    {
        $this->searchQuery = $searchQuery;
        $this->category = $category;

        if (isset($latitude, $longitude)) {
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->fetchPlaces();
        }
    }

    public function fetchPlaces(): void
    {
        $perPageForDb = 5;

        $searchParams = [
            'query' => $this->searchQuery,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'category' => $this->category,
        ];

        Session::put('searchParams', $searchParams);

        $query = \App\Models\Place::query()
            ->with(['category', 'reviews'])
            ->withCount('reviews as userRatingCount')
            ->withAvg('reviews as rating', 'rating')
            ->where('status', 'approved');;

        // Filter pencarian teks
        if (!empty($searchParams['query'])) {
            $query->where(function($q) use ($searchParams) {
                $q->where('name', 'LIKE', '%'.$searchParams['query'].'%')
                    ->orWhere('address', 'LIKE', '%'.$searchParams['query'].'%');
            });
        }

        // Filter kategori
        if (!empty($searchParams['category'])) {
            $query->whereHas('category', function($q) use ($searchParams) {
                $q->where('name', $searchParams['category']);
            });
        }

        // Filter lokasi
        if (!empty($searchParams['latitude']) && !empty($searchParams['longitude'])) {
            $latitude = $searchParams['latitude'];
            $longitude = $searchParams['longitude'];
            $radius = 10; // 10 km radius

            $query->addSelect([
                'places.*',
                DB::raw("(6371 * acos(cos(radians($latitude))
            * cos(radians(latitude))
            * cos(radians(longitude) - radians($longitude))
            + sin(radians($latitude))
            * sin(radians(latitude)))) AS distance")
            ])
                ->having('distance', '<', $radius)
                ->orderBy('distance');
        }

        $dbPlaces = $query->limit($perPageForDb)->get();

        $formattedDbPlaces = $dbPlaces->map(function ($place) {
            return [
                'id' => $place->place_unique_code,
                'formattedAddress' => $place->address,
                'name' => $place->name,
                'rating' => (float)$place->rating,
                'userRatingCount' => $place->userRatingCount,
                'displayName'=> [
                    'text' => $place->name,
                ],
                'photoUrl' => $place->thumbnail,
                'priceRange' => [
                    'startPrice' => [
                        'units' => $place->start_price
                    ],
                    'endPrice' => [
                        'units' => $place->end_price
                    ],
                ],
                'source' => 'db'
            ];
        })->toArray();

        $savedDbFormatted = [];
        foreach ($formattedDbPlaces as $place) {
            $formattedDbPlaces = \App\Helpers\FormatedHelper::priceRangeFormating($place);
            $formattedDbPlaces = \App\Helpers\FormatedHelper::ratingFormating($formattedDbPlaces);
            $savedDbFormatted[] = $formattedDbPlaces;
        }

        $totalDbPlaces = count($savedDbFormatted);
        $remainingSlots = $perPageForDb - $totalDbPlaces;

//        logger()->info('page token Parameters:', (array)$this->nextPageToken);
        $response = app('App\Services\ApiServices')->searchPlaces(
            $this->searchQuery,
            $this->category,
            $this->latitude,
            $this->longitude,
            $this->nextPageToken
        );

        $savedApiFormatted = [];
        foreach ($response['places'] ?? [] as $place) {
            $formattedApiPlaces = \App\Helpers\FormatedHelper::priceRangeFormating($place);
            $formattedApiPlaces = \App\Helpers\FormatedHelper::ratingFormating($formattedApiPlaces);
            $savedApiFormatted[] = $formattedApiPlaces;
        }


        $this->places = array_merge($this->places, $savedApiFormatted, $savedDbFormatted);

        $hasMoreDbPlaces = ($totalDbPlaces >= $perPageForDb);
        $hasMoreApiPlaces = !empty($response['nextPageToken']);

        $this->nextDbPage = $hasMoreDbPlaces ? ($this->nextDbPage ?? 0) + 1 : null;
        $this->nextPageToken = $hasMoreApiPlaces ? $response['nextPageToken'] : null;

        if (!$hasMoreDbPlaces && !$hasMoreApiPlaces) {
            $this->hasMorePlaces = false;
        }

    }

    public function loadMore(): void
    {
        $this->fetchPlaces();
    }

    #[On('updateLocation')]
    public function updateLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;

        $this->fetchPlaces();
    }

    public function render(): View
    {
        return view('livewire.search-results', [
            'places' => $this->places,
            'nextPageToken' => $this->nextPageToken,
        ]);

    }
}
