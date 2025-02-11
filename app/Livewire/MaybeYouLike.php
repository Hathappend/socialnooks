<?php

namespace App\Livewire;

use App\Services\ApiServices;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class MaybeYouLike extends Component
{
    public $latitude;
    public $longitude;
    public array $places = [];

    public function mount(): void
    {
        $this->latitude = session('latitude', '-6.2088');
        $this->longitude = session('longitude', '106.8456');
        $this->showFeaturedPlaces();
    }

    public function showFeaturedPlaces(): void
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
    public function updateLocation($lat, $lng): void
    {
        session(['latitude' => $lat, 'longitude' => $lng]);
        return;
    }
    public function render(): View
    {
        return view('livewire.maybe-you-like');
    }
}
