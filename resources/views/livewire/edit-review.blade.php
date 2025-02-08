<div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog" aria-labelledby="editReviewModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="writeReviewModalLabel">Write a Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-section modal-product">
                    @if(isset($placeDetail['thumbnail']))
                        <img src="{{ asset("storage/places/". $placeDetail['thumbnail'] ) }}" alt="Product" class="img-fluid">
                    @else
                        <img src="{{ $placeDetail['photoUrls'][0] ?? asset("storage/places/no_image.jpg" ) }}" alt="Product" class="img-fluid">
                    @endif
                    <h6>{{ $placeDetail['name'] ?? $placeDetail['displayName']['text'] }}</h6>
                    <p>{{ $placeDetail['description'] ?? $placeDetail['formattedAddress'] }}</p>
                </div>
                <div class="modal-section">
                    <div class="rating-container">
                        <div class="stars" >
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $rating >= $i ? 'text-warning' : '' }}"
                                      data-value="{{ $i }}"
                                      wire:click="$set('rating', {{ $i }})"
                                      style="cursor:pointer;">&#9733;
                                </span>
                            @endfor

                        </div>
                        <input type="hidden" id="rating" wire:model="rating" name="rating" value="0">
                    </div>
                    @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="modal-section upload-container" data-upload-container>
                    <label for="uploadPhoto" class="form-label">Add Photo or Video</label>
                    <div id="uploadPhoto" class="upload-section uploadPhoto">
                        <span id="uploadText">Click here to upload (.jpg .png .jpeg)</span>
                        <input type="file" wire:model.defer="photos" class="fileInput" id="fileInput" multiple style="display: none;">
                    </div>
                    <div id="fileList" class="file-list fileList">
                        @foreach($existingPhotos as $key => $photo)
                            <div class="file-item">
                                <span class="file-name">{{ is_string($photo) ? basename($photo) : $photo->getClientOriginalName() }}</span>
                                <button type="button" class="remove-btn" wire:click="markForRemoval({{ $key }})">Remove</button>
                            </div>
                        @endforeach
                        @foreach($photos as $index => $photo)
                            <div class="image-preview">
                                <div class="file-item">
                                    <span class="file-name">{{ is_string($photo) ? basename($photo) : $photo->getClientOriginalName() }}</span>
                                    <button type="button" class="remove-btn"  wire:click="removeNewPhoto({{ $index }})">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="modal-section review-text">
                    <label for="reviewText" class="form-label">Write your Review</label>
                    <textarea id="reviewText" wire:model="reviewText" class="form-control" rows="4" placeholder="Would you like to write anything about this product?"></textarea>
                    <small class="text-muted d-block text-end">400 characters remaining</small>
                </div>
                @error('reviewText') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="modal-footer">
                <button wire:click="updateReview" wire:loading.attr="disabled" class="btn btn-primary w-100">
                    <span wire:loading.remove>Update Review</span>
                    <span wire:loading>Submitting...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('updatedReview', (review) => {
            var modalElement = document.getElementById('editReviewModal');


            if (modalElement) {
                modalElement.classList.remove('show');
                modalElement.setAttribute('aria-hidden', 'true');
                modalElement.style.display = 'none';

                var modalBackdrop = document.querySelector('.modal-backdrop');
                if (modalBackdrop) {
                    modalBackdrop.parentNode.removeChild(modalBackdrop);
                }

                document.body.classList.remove('modal-open');
                document.body.style.paddingRight = '';
            }

            var chequebookTab = document.getElementById('chequebook-tab');
            if (chequebookTab) {
                chequebookTab.click();
            }
        });
    });
</script>



