<div x-data="{ localAddress: @entangle('address') }">
    <div class="autocomplete-container mt-3">
        <div class="input-group">
            <input type="text" wire:model.debounce.300ms="query" x-on:input="$wire.set('query', $event.target.value)" class="form-control" placeholder="Search location for find your location quickly...">
        </div>

        @if(!empty($suggestions))
            <div id="autocomplete-list" class="autocomplete-items">
                @foreach($suggestions as $suggestion)
                    <div wire:click="selectSuggestion('{{ $suggestion['text'] }}, {{ $suggestion['description'] }}', {{ $suggestion['latitude'] }}, {{ $suggestion['longitude'] }})"
                         style="cursor: pointer;">
                        <span class="text">{{ $suggestion['text'] }}</span>
                        <span class="address">{{ $suggestion['description'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="map" wire:ignore class="map-placeholder"></div>
    <textarea class="form-control mt-3"  x-model="localAddress" wire:model.live="address"  rows="3" placeholder="Detail Address..."></textarea>
    @error("address")
        <span class="error-text ">{{ $message }}</span>
    @enderror
    <div class="coordinates">
        <input type="text" id="latitude" wire:model="latitude" name="latitude"  class="form-control" placeholder="Latitude" readonly>
        <input type="text" id="longitude" wire:model="longitude" name="longitude"  class="form-control" placeholder="Longitude" readonly>
    </div>
</div>

