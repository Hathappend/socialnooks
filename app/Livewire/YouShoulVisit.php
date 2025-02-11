<?php

namespace App\Livewire;

use App\Services\ApiServices;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class YouShoulVisit extends Component
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
        $places = app(ApiServices::class)->getHomeDataPlace($this->latitude, $this->longitude, 500, 'shouldVisit');
        $this->places = $places['places'];
    }
    #[On('updateLocation')]
    public function updateLocation($lat, $lng): void
    {
        session(['latitude' => $lat, 'longitude' => $lng]);
        return;
    }
    public function render(): View
    {
        return view('livewire.you-shoul-visit');
    }
}
