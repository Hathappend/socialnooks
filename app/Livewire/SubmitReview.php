<?php

namespace App\Livewire;

use Livewire\Component;

class SubmitReview extends Component
{
    use WithFileUploads;

    public $rating = 0;
    public $reviewText = '';
    public $photos = [];

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'reviewText' => 'required|string|max:400',
        'photos.*' => 'image|max:2048',
    ];

    protected $messages = [
        'rating.required' => 'Please provide a rating first.',
        'reviewText.required' => 'Write your review here.',
        'photos.*.image' => 'The uploaded file must be an image.',
        'photos.*.max' => 'The maximum image size is 2MB.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitReview()
    {
        $this->validate();

        foreach ($this->photos as $photo) {
            $path = $photo->store('reviews', 'public');
        }

        Review::create([
            'rating' => $this->rating,
            'content' => $this->reviewText,
            'photos' => json_encode($path ?? []),
        ]);

        $this->reset(['rating', 'reviewText', 'photos']);
        $this->dispatch('reviewAdded');
    }

    public function render()
    {
        return view('livewire.submit-review');
    }
}
