<div>
    <div class="section-card ">
        <button class="edit-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            Edit
        </button>
        <div class="profile-header mb-4">
            <div class="d-flex">
                <img src="{{ asset('storage/' . ($user->photo ?? 'profiles/user_default.jpg')) }}" alt="Profile" class="profile-img">
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <span class="badge text-bg-info">{{ \Illuminate\Support\Str::headline($user->role) }}</span>
                    <p class="location pt-1">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
