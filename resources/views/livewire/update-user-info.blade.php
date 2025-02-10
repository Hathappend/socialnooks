<div class="modal fade" id="editProfileModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <div class="modal-section upload-container" data-upload-container>
                    <label for="uploadPhoto" class="form-label">Add Photo</label>
                    <div id="uploadPhoto" class="upload-section uploadPhoto">
                        <span id="uploadText">Click here to upload (.jpg .png .jpeg)</span>
                        <input type="file" wire:model.defer="photo" wire:ignore class="fileInput" id="fileInput" style="display: none;">
                    </div>
                    <div id="fileList" class="file-list fileList"></div>
                </div>
                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" wire:model="name" class="form-control">
                </div>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="modal-footer">
                <button wire:click="updateUserInfo" wire:loading.attr="disabled" class="btn btn-primary w-100">
                    <span wire:loading.remove>Submit Review</span>
                    <span wire:loading>Submitting...</span>
                </button>
            </div>
        </div>
    </div>
</div>

