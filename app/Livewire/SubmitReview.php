<?php

namespace App\Livewire;

use App\Services\ReviewService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmitReview extends Component
{
    use WithFileUploads;

    public $rating = 0;
    public $reviewText = '';
    public $photos = [];
    public ?array $placeDetail = [];

    protected function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'reviewText' => 'required|string|max:400',
            'photos.*' => 'image|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'rating.required' => 'Please provide a rating first.',
            'reviewText.required' => 'Write your review here.',
            'photos.*.image' => 'The uploaded file must be an image.',
            'photos.*.max' => 'The maximum image size is 2MB.'
        ];
    }

    public function mount(?array $placeDetail): void
    {
        $this->placeDetail = $placeDetail;
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submitReview(): void
    {
        $this->validate();

        $path = [];
        foreach ($this->photos as $photo) {
            $path[] = $photo->store('reviews', 'public');
        }

        $dataReview = [
            'rating' => $this->rating,
            'text_review' => $this->reviewText,
            'photos' => json_encode($path ?? []),
        ];

        $saved = app(ReviewService::class)->create($dataReview, $this->placeDetail);

        if ($saved) {
            session()->flash('success', 'Your review has been submitted.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }

        $this->reset(['rating', 'reviewText', 'photos']);
        $this->dispatch('reviewAdded');
    }

    public function render()
    {
        return view('livewire.submit-review');
    }
}
