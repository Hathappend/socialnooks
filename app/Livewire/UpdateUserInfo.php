<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\ReviewService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateUserInfo extends Component
{
    use WithFileUploads;

    public $name = '';
    public $photo;
    public User $user;
    public $existingPhotos = [];

    protected function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Please provide a rating first.',
            'name.max' => 'The maximum length of name is 255 characters.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.max' => 'The maximum image size is 2MB.'
        ];
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        if ($this->photo) {
            $this->photo = $user->photo;
        }

    }

    #[On('profileUpdated')]
    public function loadProfile()
    {
        $user = User::find(Auth::user()->id);

        if ($user) {
            $this->name = $user->name;
            $this->existingPhotos = $user->photo;

            $this->resetValidation();
        }
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function updateUserInfo(): void
    {
        $this->validate();

        $dataProfile= [
            'name' => $this->name,
        ];

        if (isset($this->photo)) {
            $dataProfile['photo'] = $this->photo->store('profiles', 'public');
        }

        $saved = app(UserService::class)->update($this->user->id, $dataProfile);

        if ($saved) {
            session()->flash('success', 'Your review has been submitted.');
            $this->loadProfile();
        } else {
            session()->flash('error', 'Something went wrong.');
        }

        $this->dispatch('profileUpdated');


    }
    public function render()
    {
        return view('livewire.update-user-info');
    }
}
