<?php

namespace App\Livewire;

use App\Services\ReviewService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditReview extends Component
{

    use WithFileUploads;

    public $reviewId;
    public $rating = 0;
    public $reviewText;
    public $photos = [];
    public $existingPhotos = [];
    public $removedPhotos = [];

    public ?array $placeDetail = [];

    protected function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'reviewText' => 'required|string|max:400',
            'photos' => 'nullable|array',
            'photos.*' => function ($attribute, $value, $fail) {
                if (!is_string($value) && !($value instanceof \Illuminate\Http\UploadedFile)) {
                    $fail('The uploaded file must be an image.');
                }
            },
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

    #[On('editReview')]
    public function loadReview($reviewId)
    {
        $review = app(ReviewService::class)->getReviewById($reviewId);

        if ($review) {
            $this->reviewId = $review->id;
            $this->rating = $review->rating;
            $this->reviewText = $review->text_review;

            $this->existingPhotos = $review->photos->pluck('photo')->toArray();
        }
    }

    public function updateReview(): void
    {
        $this->validate();

        foreach ($this->removedPhotos as $photo) {
            Storage::disk('public')->delete($photo);
            app(ReviewService::class)->deletePhoto($this->reviewId, $photo);
        }

        $path = [];
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                if (!is_string($photo)) {
                    $path[] = $photo->store('reviews', 'public');
                } else {
                    $path[] = $photo;
                }
            }
        }

        $dataReview = [
            'rating' => $this->rating,
            'text_review' => $this->reviewText,
            'photos' => json_encode($path ?? []),
        ];

        $saved = app(ReviewService::class)->update($dataReview, $this->reviewId);

        if ($saved) {
            session()->flash('success', 'Your review has been updated.');
            $this->photos = [];
            $this->loadReview($this->reviewId);
        } else {
            session()->flash('error', 'Something went wrong.');
        }

        $this->removedPhotos = [];

        $this->dispatch('updatedReview');
    }

    public function markForRemoval($index)
    {
        $photo = $this->existingPhotos[$index];

        if (is_string($photo)) {
            $this->removedPhotos[] = $photo;
        }

        unset($this->existingPhotos[$index]);

        $this->existingPhotos = array_values($this->existingPhotos);
    }

    public function removeNewPhoto($index)
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            $this->photos = array_values($this->photos);
        }
    }


    public function render()
    {
        return view('livewire.edit-review');
    }
}
