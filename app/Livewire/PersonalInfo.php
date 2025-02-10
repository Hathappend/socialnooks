<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PersonalInfo extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    #[On('profileUpdated')]
    public function loadProfile()
    {
        $user = User::find(Auth::user()->id);

        if ($user) {
            $this->user = $user;
        }
    }

    public function render()
    {
        return view('livewire.personal-info');
    }
}
