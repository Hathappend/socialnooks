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
                    <img src="https://uwitan.id/wp-content/uploads/2018/06/1.-Furniture-Kursi-Classic-Chair-Natural.jpeg" alt="Product" class="img-fluid">
                    <h6>Bjorg Chair White Plastic</h6>
                    <p>Armchair in polypropylene. Seat and legs in solid natural beech wood.</p>
                </div>
                <div class="modal-section">
                    <div class="rating-container">
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $rating >= $i ? 'text-warning' : '' }}" wire:click="$set('rating', {{ $i }})" style="cursor:pointer;">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0">
                    </div>
                </div>
                <div class="modal-section">
                    <label for="uploadPhoto" class="form-label">Add Photo or Video</label>
                    <div id="uploadPhoto" class="upload-section">
                        <span id="uploadText">Click here to upload</span>
                        <input type="file" wire:model="photos" id="fileInput" multiple style="display: none;">
                    </div>
                    <div id="fileList" class="file-list"></div>
                    @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="modal-section review-text">
                    <label for="reviewText" class="form-label">Write your Review</label>
                    <textarea id="reviewText" wire-model="reviewText" class="form-control" rows="4" placeholder="Would you like to write anything about this product?"></textarea>
                    <small class="text-muted d-block text-end">400 characters remaining</small>
                </div>
                @error('reviewText') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="modal-footer" style="border: 1px solid bla;">
                <button wire:click="submitReview" class="btn btn-primary w-100">Submit Review</button>
            </div>
        </div>
    </div>
</div>
