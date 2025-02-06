<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class OperationalHours extends Component
{
    public array $operationalHours = [];
    public array $savedOperationalHours = [];

    public $hasErrors = false;

    protected function rules(): array
    {
        return [
            'operationalHours.*.day' => 'required',
            'operationalHours.*.start' => 'required',
            'operationalHours.*.end' => 'required|after:operationalHours.*.start',
        ];
    }

    protected function messages(): array
    {
        return [
            'operationalHours.*.day.required' => 'The day field is required.',
            'operationalHours.*.start.required' => 'The start hour is required.',
            'operationalHours.*.end.required' => 'The end hour is required.',
            'operationalHours.*.end.after' => 'The end hour cannot be after the start hour.',

        ];
    }

    public function mount(): void
    {
        $this->operationalHours = [
            ['day' => '', 'start' => '', 'end' => '']
        ];

        try {
            $this->validate();
            $this->hasErrors = false;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
            $this->hasErrors = true;
            $this->dispatch('validationStatusUpdated', hasErrors: $this->hasErrors);
        }

    }

    public function updated($propertyName): void
    {
        if (str_starts_with($propertyName, 'operationalHours')) {
            $this->updateSavedOperationalHours();
        }
    }

    public function addOperationalHour(): void
    {
        $this->operationalHours[] = ['day' => '', 'start' => '', 'end' => ''];
        $this->dispatch('updateOperationalOverview', $this->savedOperationalHours);
    }

    public function removeOperationalHour($index): void
    {
        unset($this->operationalHours[$index]);
        $this->operationalHours = array_values($this->operationalHours);
        $this->updateSavedOperationalHours();
    }

    public function updateSavedOperationalHours(): void
    {

        try {
            $this->validate();
            $this->hasErrors = false;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
            $this->hasErrors = true;
        }

        $this->dispatch('validationStatusUpdated', hasErrors: $this->hasErrors);

        if ($this->hasErrors) {
            return;
        }

        $this->savedOperationalHours = array_filter($this->operationalHours, function ($hour) {
            return !empty($hour['day']) && !empty($hour['start']) && !empty($hour['end']);
        });

        $this->dispatch('updateOperationalOverview', $this->savedOperationalHours);
    }

    public function render():View
    {
        return view('livewire.operational-hours');
    }
}
