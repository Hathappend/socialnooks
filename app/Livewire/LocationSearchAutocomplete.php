<?php

namespace App\Livewire;

use App\Services\ApiServices;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Modelable;

class LocationSearchAutocomplete extends Component
{

    public $query ;
    public array $suggestions = [];
    public $latitude = -6.2088;
    public $longitude =106.8456;

    #[Modelable]
    public $address;

    public $desc = '';

    protected function rules(): array
    {
        return [
            'address' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'address.required' => 'The start price field is required.',
        ];
    }

    public function mount(): void
    {
        $this->validate();
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {

        $this->validateOnly($propertyName);
    }

    public function updatedQuery(): void
    {
        if (strlen($this->query) > 2) {
            $response = app('App\Services\ApiServices')->getAutocompleteSuggestions($this->query, $this->latitude, $this->longitude);
            if (isset($response['suggestions'])) {
                $this->suggestions = collect($response['suggestions'])->map(function ($suggestion) {
                    if (isset($suggestion['placePrediction'])) {
                        $prediction = $suggestion['placePrediction'];

                        $location = \app('App\Services\ApiServices')->getLangLngFromByPlaceId($prediction['placeId']);

                        return [
                            'text' => $prediction['structuredFormat']['mainText']['text'] ?? '',
                            'place_id' => $prediction['placeId'] ?? '',
                            'description' => $prediction['structuredFormat']['secondaryText']['text'] ?? '',
                            'latitude' => $location['location']['latitude'],
                            'longitude' => $location['location']['longitude'],
                        ];
                    }
                    return null;
                })->filter()->values()->toArray();

            } else {
                $this->suggestions = [];
            }
        } else {
            $this->suggestions = [];
        }
    }

    public function selectSuggestion($description, $lat, $lng): void
    {
        $this->query = $description;
        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->suggestions = [];
        $this->dispatch('location-updated', detail: [
            'latitude' => $lat,
            'longitude' => $lng
        ]);
    }
    #[On('setUserCurrentLocation')]
    public function setUserCurrentLocation($lat, $lng): void
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->dispatch('location-updated', detail: [
            'latitude' => $lat,
            'longitude' => $lng
        ]);
    }


    public function render():View
    {
        return view('livewire.location-search-autocomplete');
    }
}
