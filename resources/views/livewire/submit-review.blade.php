<div class="modal fade" id="writeReviewModal" tabindex="-1" role="dialog" aria-labelledby="writeReviewModal" aria-hidden="true" wire:ignore>
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
                        <img src="{{ asset("storage/". $placeDetail['thumbnail'] ) }}" alt="Product" class="img-fluid">
                    @else
                        <img src="{{ $placeDetail['photoUrls'][0] ?? asset("storage/places/no_image.jpg" ) }}" alt="Product" class="img-fluid">
                    @endif
                    <h6>{{ $placeDetail['name'] ?? $placeDetail['displayName']['text'] }}</h6>
                    <p>{{ $placeDetail['description'] ?? $placeDetail['formattedAddress'] }}</p>
                </div>
                <div class="modal-section">
                    <div class="rating-container">
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $rating >= $i ? 'text-warning' : '' }}"
                                      data-value="{{ $i }}"
                                      wire:click="$set('rating', {{ $i }})"
                                      style="cursor:pointer;">&#9733;
                                </span>
                            @endfor

                        </div>
                        <input type="hidden" id="rating" name="rating" value="0">
                    </div>
                    @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="modal-section upload-container" data-upload-container>
                    <label for="uploadPhoto" class="form-label">Add Photo</label>
                    <div id="uploadPhoto" class="upload-section uploadPhoto">
                        <span id="uploadText">Click here to upload (.jpg .png .jpeg)</span>
                        <input type="file" wire:model.defer="photos" class="fileInput" id="fileInput" multiple style="display: none;">
                    </div>
                    <div id="fileList" class="file-list fileList"></div>
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
                <button wire:click="submitReview" wire:loading.attr="disabled" class="btn btn-primary w-100">
                    <span wire:loading.remove>Submit Review</span>
                    <span wire:loading>Submitting...</span>
                </button>
            </div>
        </div>
    </div>
</div>


