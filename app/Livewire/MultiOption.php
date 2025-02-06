<?php

namespace App\Livewire;

use App\Models\Accessibility;
use App\Repositories\CategoryRepository;
use App\Services\AccessibilityService;
use App\Services\CategoryService;
use App\Services\FacilityService;
use App\Services\PaymentService;
use App\Services\ServiceService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class MultiOption extends Component
{

    use withFileUploads;

    public array $selectedFacilities = [];
    public array $selectedFacilityNames = [];
    public array $selectedServices = [];
    public array $selectedServiceNames = [];
    public array $selectedPayments = [];
    public array $selectedPaymentNames = [];
    public array $selectedAccessibilities = [];
    public array $selectedAccessibilityNames = [];

    public $place_name;
    public $start_price = '';
    public $end_price = '';
    public $desc = '';
    public $phone_number='';
    public $file_upload = [];
    public $previewUrls = [];

    public $address = '';

    public $category = '';

    public Collection $categories;

    public array $facilities = [];

    public array $services = ['Cleaning', 'Laundry', 'Security', 'Concierge', 'Room Service'];
    public array $payments = ['Cash', 'Kris', 'Kartu Debit', 'Kartu Kredit'];
    public array $accessibilities = ['Kurso Roda', 'Toilet Disabilitas'];
    public $hasOperationalHourErrors = false;

    protected function rules()
    {
        return [
            'start_price' => 'required|numeric',
            'end_price' => 'required|numeric|gt:start_price',
            'desc' => 'required',
            'category' => 'required',
            'place_name' => 'required',
            'phone_number' => 'required|numeric|regex:/^\+?[0-9]{8,15}$/',
            'file_upload.*' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'file_upload' => 'required|array|max:5',
        ];
    }

    protected function messages()
    {
        return [
            'start_price.required' => 'The start price field is required.',
            'end_price.required' => 'The end price is required.',
            'start_price.numeric' => 'The start price must be a number.',
            'end_price.numeric' => 'The end price must be a number.',
            'desc.required' => 'The description is required.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.numeric' => 'The phone number must be a number.',
            'place_name.required' => 'The place name field is required.',
            'category.required' => 'Must select a category.',
            'file_upload.mimes' => 'Only JPG, PNG, and JPEG formats are allowed',
            'file_upload.required' => 'At least 1 file must be uploaded',
            'file_upload.max' => 'A maximum of 5 files can be uploaded',
            'file_upload.*.required' => 'File is required to be uploaded',
            'file_upload.*.mimes' => 'Only JPG, PNG, and JPEG formats are allowed',
            'file_upload.*.max' => 'Maximum file size is 2MB',

        ];
    }

    public function mount(): void
    {
        $this->getCategories();
        $this->getFacilities();
        $this->getServices();
        $this->getPayments();
        $this->getAccessibilities();
        $this->validate();
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        if ($propertyName === 'file_upload') {
            $this->handleFilePreview();
            return;
        }

        $this->validateOnly($propertyName);
    }

    /**
     * @throws ValidationException
     */
    public function handleFilePreview(): void
    {
        $this->validateOnly('file_upload');
        $this->previewUrls = [];

        foreach ($this->file_upload as $file) {
            $this->previewUrls[] = $file->temporaryUrl();
        }
    }

    #[On('validationStatusUpdated')]
    public function handleOperationalHourErrors($hasErrors): void
    {
        $this->hasOperationalHourErrors = $hasErrors;
    }

    public function toggleFacility($facilityId): void
    {

        if (($key = array_search($facilityId, $this->selectedFacilities)) !== false) {
            unset($this->selectedFacilities[$key]);
        } else {
            $this->selectedFacilities[] = $facilityId;
        }

        $results = app(FacilityService::class)->filterColumn('id', $this->selectedFacilities)->pluck('name')->toArray();

        $this->selectedFacilityNames = $results;
    }

    public function toggleService($serviceId): void
    {

        if (in_array($serviceId, $this->selectedServices)) {
            $this->selectedServices = array_diff($this->selectedServices, [$serviceId]);
        } else {
            $this->selectedServices[] = $serviceId;
        }

        $results = app(ServiceService::class)->filterColumn('id', $this->selectedServices)->pluck('name')->toArray();

        $this->selectedServiceNames = $results;
    }

    public function togglePayment($paymentId): void
    {

        if (($key = array_search($paymentId, $this->selectedPayments)) !== false) {
            unset($this->selectedPayments[$key]);
        } else {
            $this->selectedPayments[] = $paymentId;
        }

        $results = app(PaymentService::class)->filterColumn('id', $this->selectedPayments)->pluck('name')->toArray();

        $this->selectedPaymentNames = $results;

    }

    public function toggleAccessibility($accessibilityId): void
    {

        if (($key = array_search($accessibilityId, $this->selectedAccessibilities)) !== false) {
            unset($this->selectedAccessibilities[$key]);
        } else {
            $this->selectedAccessibilities[] = $accessibilityId;
        }

        $results = app(AccessibilityService::class)->filterColumn('id', $this->selectedAccessibilities)->pluck('name')->toArray();

        $this->selectedAccessibilityNames = $results;
    }

    public function removeService($service): void
    {
        $this->selectedServices = array_diff($this->selectedServices, [$service]);
    }

    public function getCategories(): void
    {
        $this->categories = \app(CategoryService::class)->getCategories();
    }

    public function getFacilities(): void
    {
        $this->facilities = \app(FacilityService::class)->getFacilities()->toArray();
    }

    public function getServices(): void
    {
        $this->services = \app(ServiceService::class)->getServices()->toArray();
    }

    public function getPayments(): void
    {
        $this->payments = \app(PaymentService::class)->getPayments()->toArray();
    }

    public function getAccessibilities(): void
    {
        $this->accessibilities = \app(AccessibilityService::class)->getAccessibilities()->toArray();
    }

    public function render():View
    {
        return view('livewire.multi-option');
    }
}


