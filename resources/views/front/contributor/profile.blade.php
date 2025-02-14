@extends('layouts.app')
@section('page_title', 'Profile')
@section('additional_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/place-detail.css') }}">
@endsection

@section('main_content')
    <div class="container">
        <a href="{{ route('front.index') }}" class="btn mt-3 mb-3">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <!-- Mobile Navigation -->
        <div class="mobile-nav">
            <div class="mobile-nav-items">
                <div class="mobile-nav-item active" data-tab="tab-info">Personal Info</div>
                <div class="mobile-nav-item" data-tab="tab-place">Places</div>
                <div class="mobile-nav-item" data-tab="tab-review">Reviews</div>
                <div class="mobile-nav-item" data-tab="tab-account">Account</div>
                <div class="mobile-nav-item" data-tab="tab-preference">Preference</div>
            </div>
        </div>

        <div class="d-flex">
            <!-- Sidebar -->
            <nav class="sidebar-nav">
                <div class="sidebar-item active" data-tab="tab-info">Personal Info</div>
                <div class="sidebar-item" data-tab="tab-place">Places</div>
                <div class="sidebar-item" data-tab="tab-review">Reviews</div>
                <div class="sidebar-item" data-tab="tab-account">Account</div>
                <div class="sidebar-item" data-tab="tab-preference">Preference</div>
            </nav>

            <!-- Main Content -->
            <div class="main-content flex-grow-1">
                <!-- Info Tab -->
                @if(session()->has('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Congratulations!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="tab-content active" id="tab-info">
                    <h1 class="page-title">Personal Info</h1>
                    @livewire('personal-info', ['user' => $user])
                </div>

                <!-- Place Tab -->
                <div class="tab-content" id="tab-place">

                    <div class="wrapper">
                        @if($pendingPlace)
                            <h1 class="page-title">Waiting to Approve</h1>
                        @endif
                        @forelse($pendingPlace as $place)
                            <div class="transaction-card">
                                <div class="icon mt-1"><img src="{{ asset("storage/{$place->thumbnail}") }}" alt="User Image"></div>
                                <div class="details mt-1 mb-1">
                                    <strong>{{ $place->name }}</strong>
                                    <div class="pt-2 pb-1">{{ \Carbon\Carbon::parse($place->created_at)->diffForHumans() }}</div>
                                    <span class="badge text-bg-secondary">{{ \Illuminate\Support\Str::upper($place->status) }}</span>
                                </div>
                                <button class="delete-btn">❌</button>
                            </div>
                        @empty
                            <div class="transaction-card">
                                <small class="text-center">You haven't pending place yet </small>
                            </div>
                        @endforelse

                        @if($approvedPlace)
                            <h1 class="page-title mt-5 pt-5">Approved Place</h1>
                        @endif

                        @forelse($approvedPlace as $place)
                            <div class="transaction-card">
                                <div class="icon mt-1"><img src="{{ asset("storage/{$place->thumbnail}") }}" alt="User Image"></div>
                                <div class="details mt-1 mb-1">
                                    <strong>{{ $place->name }}</strong>
                                    <div class="pt-2 pb-1">{{ \Carbon\Carbon::parse($place->created_at)->diffForHumans() }}</div>
                                    <span class="badge text-bg-success">{{ \Illuminate\Support\Str::upper($place->status) }}</span>
                                </div>
                                <a href="{{ route('api.place.details', $place->place_unique_code) }}" class="delete-btn">
                                    <i class="fa-regular fa-eye" style="font-size: 20px; margin-right: 10px;"></i>
                                </a>
                            </div>
                        @empty
                            <div class="transaction-card">
                                <small class="text-center">You haven't approved place yet </small>
                            </div>
                        @endforelse

                        @if(empty($rejectedPlace))
                            <h1 class="page-title mt-5 pt-5">Rejected Place</h1>
                                @forelse($rejectedPlace as $place)
                                    <div class="transaction-card">
                                        <div class="icon mt-1"><img src="{{ asset("storage/{$place->thumbnail}") }}" alt="User Image"></div>
                                        <div class="details mt-1 mb-1">
                                            <strong>{{ $place->name }}</strong>
                                            <div class="pt-2 pb-1">{{ \Carbon\Carbon::parse($place->created_at)->diffForHumans() }}</div>
                                            <span class="badge text-bg-danger">{{ \Illuminate\Support\Str::upper($place->status) }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="transaction-card">
                                        <small class="text-center">You haven't rejected place yet </small>
                                    </div>
                                @endforelse
                        @endif

                    </div>

                </div>

                <!-- Review Tab -->
                <div class="tab-content" id="tab-review">
                    <h1 class="page-title">Review History</h1>
                    @forelse($reviews  as $review)
                        <div class="section-card ">
                            <a href="{{ route('api.place.details', $review->place->place_unique_code) }}" class="edit-button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit
                            </a>
                            <div class="row review-card align-items-center flex-md-row flex-column text-md-start text-center">
                                <div class="col-auto mb-3 mb-md-0">
                                    <img src="{{ asset('storage/'. ($review->photos->first()?->photo ?? 'places/no_image.jpg')) }}" alt="Product Image">
                                </div>
                                <div class="col d-flex flex-column">
                                    <h5 class="text-primary">{{ $review->place->name }}</h5>

                                    <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
                                    <strong class="pt-3">Your Review:</strong>
                                    <div class="text-warning pt-2">{{ \App\Helpers\FormatedHelper::starsFormating($review['rating']) }}</div>
                                    <small class="pt-2">{{$review->text_review}}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="transaction-card">
                            <small class="text-center">You haven't reviews for a place yet </small>
                        </div>
                    @endforelse

                </div>


                <!-- Acount -->
                <div class="tab-content" id="tab-account">
                    <h1 class="page-title">Account</h1>
                    <div class="section-card">
                        <a href="{{ route('password.request') }}" class="btn btn-outline-primary" style="width: 100%">Change Password</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger mb-3 mt-2" style="width: 100%">Logout</button>
                        </form>
                    </div>
                </div>

                <!-- Preference Tab -->
                <div class="tab-content" id="tab-preference">
                    <h1 class="page-title">Keamanan</h1>
                    <div class="section-card">
                        <button class="edit-button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit
                        </button>
                        <p>Pengaturan keamanan akun Anda</p>
                    </div>
                </div>

                <!-- Add other tab contents similarly -->
            </div>
        </div>
    </div>

    @livewire('update-user-info', ['user' => $user])

    <!-- Edit Personal Info Modal -->
    <div class="modal fade" id="editPersonalInfoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editPersonalInfoForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" value="Jack">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" value="Adams">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="jackadams@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" value="(213) 555-1234">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" rows="3">Product Designer</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    const section = this.closest('.section-card');

                    if (section && (section.querySelector('.profile-header') || section.querySelector('.info-grid'))) {
                        e.preventDefault();

                        if (section.querySelector('.profile-header')) {
                            new bootstrap.Modal(document.getElementById('editProfileModal')).show();
                        } else if (section.querySelector('.info-grid')) {
                            new bootstrap.Modal(document.getElementById('editPersonalInfoModal')).show();
                        }
                    }
                });
            });

            document.querySelectorAll('.modal form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('Form submitted');
                });
            });
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function switchTab(tabId) {
                document.querySelectorAll('.sidebar-item, .mobile-nav-item').forEach(item => {
                    item.classList.remove('active');
                });

                document.querySelectorAll(`[data-tab="${tabId}"]`).forEach(item => {
                    item.classList.add('active');
                });

                document.querySelectorAll('.tab-content').forEach(section => {
                    section.classList.remove('active');
                });

                const selectedContent = document.getElementById(tabId);
                if (selectedContent) {
                    selectedContent.classList.add('active');
                }
            }

            document.querySelectorAll('.sidebar-item, .mobile-nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    switchTab(tabId);
                });
            });

            const initialTab = document.querySelector('.sidebar-item.active').getAttribute('data-tab');
            switchTab(initialTab);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("[data-upload-container]").forEach((container) => {
                const uploadPhotoBtn = container.querySelector(".uploadPhoto");
                const fileInput = container.querySelector(".fileInput");
                const fileListContainer = container.querySelector(".fileList");
                const uploadText = container.querySelector(".uploadText");

                if (uploadPhotoBtn && fileInput) {
                    uploadPhotoBtn.addEventListener("click", function () {
                        fileInput.click();
                    });

                    fileInput.addEventListener("change", function () {
                        fileListContainer.innerHTML = "";

                        const files = fileInput.files;

                        if (files.length > 0) {
                            Array.from(files).forEach((file, index) => {
                                const fileItem = document.createElement("div");
                                fileItem.className = "file-item";

                                const fileName = document.createElement("span");
                                fileName.textContent = file.name;

                                const removeBtn = document.createElement("button");
                                removeBtn.textContent = "Remove";
                                removeBtn.className = "remove-btn";
                                removeBtn.addEventListener("click", function () {
                                    removeFile(fileInput, index);
                                });

                                fileItem.appendChild(fileName);
                                fileItem.appendChild(removeBtn);
                                fileListContainer.appendChild(fileItem);
                            });
                        } else {
                            uploadText.textContent = "Click here to upload (.jpg .png .jpeg)";
                        }
                    });
                }
            });

            function removeFile(input, index) {
                const dataTransfer = new DataTransfer();

                Array.from(input.files).forEach((file, i) => {
                    if (i !== index) {
                        dataTransfer.items.add(file);
                    }
                });

                input.files = dataTransfer.files;

                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    </script>

    <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('profileUpdated', (review) => {
                var modalElement = document.getElementById('editProfileModal');


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

            });
        });
    </script>

@endsection

