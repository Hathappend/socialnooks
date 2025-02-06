<?php

namespace App\Livewire;

use App\Services\ApiServices;
use Livewire\Attributes\On;
use Livewire\Component;

class MaybeYouLike extends Component
{
    public $latitude;
    public $longitude;
    public array $places = [];

    public function mount()
    {
        $this->latitude = '-6.2088';
        $this->longitude = '106.8456';
//        $this->showFeaturedPlaces();
    }

    public function showFeaturedPlaces()
    {
        $places = app(ApiServices::class)->getHomeDataPlace($this->latitude, $this->longitude, 2000, 'maybeYouLike');

        $savedFormatted = [];
        foreach ($places['places'] as $place) {
            $formattedPlaces = \App\Helpers\FormatedHelper::priceRangeFormating($place);
            $formattedPlaces = \App\Helpers\FormatedHelper::ratingFormating($formattedPlaces);
            $savedFormatted[] = $formattedPlaces;
        }
        $this->places = $savedFormatted;
    }
    #[On('updateLocation')]
    public function updateLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
//        $this->showFeaturedPlaces();
    }
    public function render()
    {
        return view('livewire.maybe-you-like');
    }
}
