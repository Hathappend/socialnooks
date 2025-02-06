<?php

namespace App\Livewire;

use App\Services\ApiServices;
use Livewire\Attributes\On;
use Livewire\Component;

class YouShoulVisit extends Component
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
        $places = app(ApiServices::class)->getHomeDataPlace($this->latitude, $this->longitude, 500, 'shouldVisit');
        $this->places = $places['places'];
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
        return view('livewire.you-shoul-visit');
    }
}
