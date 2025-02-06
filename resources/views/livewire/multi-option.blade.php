<div x-data="{
    place_name: @entangle('place_name').defer,
    start_price: @entangle('start_price').defer,
    end_price: @entangle('end_price').defer,
    desc: @entangle('desc').defer,
    phone_number: @entangle('phone_number').defer,
    category: @entangle('category').defer
}"
>
    <form action="{{ route('contrib.place.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="wizard-card">
            <div class="col-md-4 sidebar">
                <div class="step-indicator">
                    <span class="active" id="step1-indicator">1</span>
                    <span id="step2-indicator">2</span>
                    <span id="step3-indicator">3</span>
                </div>
                <div class="desc">
                    <h5 id="sidebar-title">Detail Information</h5>
                    <p class="description" id="sidebar-description">Please set your location that you want to show to people looking for property</p>
                </div>
                <p class="help">Call 0043-57385 for help</p>
            </div>
            <div class="col-md-8 content active" id="step1">
                <h4>Detail Information</h4>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <input type="text" x-model="place_name"  wire:model.live.debounce.300ms="place_name" class="form-control" placeholder="Place name">
                        @error("place_name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-3">
                        <input type="text" x-model="start_price"  wire:model.live.debounce.300ms="start_price" class="form-control" placeholder="Start Price">
                        @error("start_price")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-3">
                        <input type="text" x-model="end_price"  wire:model.live.debounce.300ms="end_price" class="form-control" placeholder="End Price">
                        @error("end_price")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <textarea class="form-control mt-3" x-model="desc"  wire:model.live.debounce.300ms="desc" rows="3" placeholder="Description"></textarea>
                @error("desc")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" x-model="phone_number"  wire:model.live.debounce.300ms="phone_number" class="form-control mt-3" placeholder="Phone Number">
                @error("phone_number")
                    <span class="text-danger ">{{ $message }}</span>
                @enderror

                @livewire('operational-hours')

                <div class="multi-option-container">
                    <input type="text" class="search-box" placeholder="🔍 Search facilities..." onkeyup="filterOptions('facilityOptions', this)">
                    <div class="multi-option" id="facilityOptions">
                        @foreach($facilities as $facility)

                            <input type="checkbox" id="facility{{ $loop->iteration }}" wire:click="toggleFacility('{{ $facility['id'] }}')"
                                   @if(in_array($facility['id'], $selectedFacilities)) checked @endif>
                            <label for="facility{{ $loop->iteration }}">{{ $facility['name'] }}</label>

                        @endforeach
                    </div>
                </div>

                <div class="multi-option-container">
                    <input type="text" class="search-box" placeholder="🔍 Search services..." onkeyup="filterOptions('serviceOptions', this)">
                    <div class="multi-option" id="serviceOptions">
                        @foreach($services as $service)

                            <input type="checkbox" id="service{{ $loop->iteration }}" wire:click="toggleService('{{ $service['id'] }}')"
                                   @if(in_array($service['id'], $selectedServices)) checked @endif>
                            <label for="service{{ $loop->iteration }}">{{ $service['name'] }}</label>

                        @endforeach
                    </div>
                </div>

                <div class="multi-option-container">
                    <input type="text" class="search-box" placeholder="🔍 Search payment options..." onkeyup="filterOptions('paymentOptions', this)">
                    <div class="multi-option" id="paymentOptions">
                        @foreach($payments as $payment)

                            <input type="checkbox" id="payment{{ $loop->iteration }}" wire:click="togglePayment('{{ $payment['id'] }}')"
                                   @if(in_array($payment['id'], $selectedPayments)) checked @endif>
                            <label for="payment{{ $loop->iteration }}">{{ $payment['name'] }}</label>

                        @endforeach
                    </div>
                </div>

                <div class="multi-option-container">
                    <input type="text" class="search-box" placeholder="🔍 Search accessibilities..." onkeyup="filterOptions('accessibilityOptions', this)">
                    <div class="multi-option" id="accessibilityOptions">
                        @foreach($accessibilities as $accessibility)

                            <input type="checkbox" id="accessibility{{ $loop->iteration }}" wire:click="toggleAccessibility('{{ $accessibility['id'] }}')"
                                   @if(in_array($accessibility['id'], $selectedAccessibilities)) checked @endif>
                            <label for="accessibility{{ $loop->iteration }}">{{ $accessibility['name'] }}</label>

                        @endforeach
                    </div>
                </div>

                <select x-model="category" wire:model.live.debounce.300ms="category" name="category" class="form-control" style="border: 1px solid gray">
                    <option value="">Choose Category:</option>
                    @forelse($categories as $category)
                        <option value="{{$category->id}}">{{ \Illuminate\Support\Str::headline($category->name) }}</option>
                    @empty
                    @endforelse
                </select>

                @error('category') <span class="text-danger">{{ $message }}</span> @enderror

                <input type="file" wire:model="file_upload" name="photos[]" class="form-control mt-3" multiple>
                @error('file_upload') <span class="text-danger">{{ $message }}</span> @enderror
                @error('file_upload.*') <span class="text-danger">{{ $message }}</span> @enderror

                <div class="img-preview-container mt-3">
                    @foreach($previewUrls as $url)
                        <img src="{{ $url }}" class="img-preview">
                    @endforeach
                </div>

                <div class="buttons mt-5 d-flex justify-content-end">
                    @if($hasOperationalHourErrors || $errors->isNotEmpty())
                        <button type="button" class="btn btn-danger rounded-pill" onclick="nextStep(2)"
                                id="nextStepButton" disabled>Next Step
                            <i class="fa-solid fa-circle-exclamation"></i>

                        </button>
                    @else
                        <button type="button" class="btn btn-primary rounded-pill" onclick="nextStep(2)"
                                id="nextStepButton">Next Step
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    @endif

                </div>

            </div>

            <div class="col-md-8 content" id="step2">
                <h4>Set Location</h4>

                @livewire('location-search-autocomplete', [ 'wire:model.debounce.500ms' => 'address'], key('input'))

                <div class="buttons mt-5">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" onclick="prevStep(1)">Previous</button>
                    @if($hasOperationalHourErrors || $errors->isNotEmpty())
                        <button type="button" class="btn btn-danger rounded-pill" onclick="nextStep(3)"
                                id="nextStepButton" disabled>Next Step
                            <i class="fa-solid fa-circle-exclamation"></i>

                        </button>
                    @else
                        <button type="button" class="btn btn-primary rounded-pill" onclick="nextStep(3)"
                                id="nextStepButton">Next Step
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    @endif
                </div>
            </div>
            <div class="col-md-8 content" id="step3">
                <div class="row">
                    <div class="col-12">
                        <h4>Confirm & Finish</h4>
                        <div class="row">
                            <div class="col-md-12 mt-3 coordinates">
                                <input type="text" x-model="place_name" name="name" class="form-control" placeholder="Start Price">
                            </div>
                            <div class="col-md-6 mt-3 coordinates">
                                <input type="text" x-model="start_price" name="start_price" class="form-control" placeholder="Start Price" readonly>
                            </div>
                            <div class="col-md-6 mt-3 coordinates" >
                                <input type="text" x-model="end_price" name="end_price" class="form-control" placeholder="End Price" readonly>
                            </div>
                        </div>
                        <div class="coordinates">
                            <textarea class="form-control mt-3" x-model="desc" name="description" rows="3" placeholder="Description" readonly></textarea>
                        </div>
                        <div class="coordinates">
                            <input type="text" x-model="phone_number" name="phone_number" class="form-control mt-3 mb-3 " placeholder="Phone Number" readonly>
                        </div>
                        <livewire:operational-overview />
                    </div>
                </div>
                <div id="map-overview" wire:ignore class="map-placeholder">
                </div>

                <div class="coordinates">
                    <textarea class="form-control mt-3" wire:model.live="address" name="address"  rows="3" placeholder="Detail address.." readonly></textarea>
                </div>

                <p class="pt-4"><strong>Selected Facility:</strong></p>
                <div class="multi-option-container">
                    <div class="multi-option" id="accessibilityOptions">
                        @if(count($selectedFacilityNames) > 0)
                            @foreach($selectedFacilityNames as $selected)
                                <span class="selectedItem">
                                {{ $selected }}
                            </span>
                            @endforeach
                        @else
                            <p style="color: gray;">No service has been selected yet.</p>
                        @endif
                    </div>
                </div>

                <p class="pt-2"><strong>Selected Services:</strong></p>
                <div class="multi-option-container">
                    <div class="multi-option" id="accessibilityOptions">
                        @if(count($selectedServiceNames) > 0)
                            @foreach($selectedServiceNames as $selected)
                                <span class="selectedItem">
                                {{ $selected }}
                            </span>
                            @endforeach
                        @else
                            <p style="color: gray;">No service has been selected yet.</p>
                        @endif
                    </div>
                </div>

                <p class="pt-2"><strong>Selected Payment:</strong></p>
                <div class="multi-option-container">
                    <div class="multi-option" id="accessibilityOptions">
                        @if(count($selectedPaymentNames) > 0)
                            @foreach($selectedPaymentNames as $selected)
                                <span class="selectedItem">
                                {{ $selected }}
                            </span>
                            @endforeach
                        @else
                            <p style="color: gray;">No payment method option has been selected yet.</p>
                        @endif
                    </div>
                </div>

                <p class="pt-2"><strong>Selected Accessibility:</strong></p>
                <div class="multi-option-container">
                    <div class="multi-option" id="accessibilityOptions">
                        @if(count($selectedAccessibilityNames) > 0)
                            @foreach($selectedAccessibilityNames as $selected)
                                <span class="selectedItem">
                                    {{ $selected }}
                                </span>

                            @endforeach
                        @else
                            <p style="color: gray;">No accessibility has been selected yet.</p>
                        @endif
                    </div>
                </div>

                <p class="pt-2"><strong>Uploaded Image:</strong></p>
                <div class="img-preview-container mt-3">
                    @foreach($previewUrls as $url)
                        <img src="{{ $url }}" class="img-preview">
                    @endforeach
                </div>

                <!-- Input hidden untuk dikirim ke PHP -->
                <input type="hidden" name="selected_facilities" value="{{ json_encode($selectedFacilities) }}">
                <input type="hidden" name="selected_services" value="{{ json_encode($selectedServices) }}">
                <input type="hidden" name="selected_payments" value="{{ json_encode($selectedPayments) }}">
                <input type="hidden" name="selected_accessibilities" value="{{ json_encode($selectedAccessibilities) }}">

                <div class="buttons mt-5">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" onclick="prevStep(2)">Previous</button>
                    <button class="btn btn-primary rounded-pill" type="submit" >Finish</button>
                </div>
            </div>
        </div>

    </form>
</div>


