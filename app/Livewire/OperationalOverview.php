<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class OperationalOverview extends Component
{
    public array $savedOperationalHours = [];

    protected $listeners = ['updateOperationalOverview' => 'updateOperationalData'];

    public function updateOperationalData($data): void
    {
        $this->savedOperationalHours = $data;
    }

    public function render():View
    {
        return view('livewire.operational-overview', [
            'operationalHours' => $this->savedOperationalHours
        ]);
    }
}
