<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\PlaceService;
use App\Services\ReviewService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    private PlaceService $placeService;
    private ReviewService $reviewService;

    public function __construct(PlaceService $placeService, ReviewService $reviewService)
    {
        $this->placeService = $placeService;
        $this->reviewService = $reviewService;
    }

    public function index(): View
    {
        $user = Auth::user();
        $pendingPlace = $this->placeService->getPendingPlaceByUserId($user->id, 'Pending');
        $approvedPlace = $this->placeService->getApprovedPlaceByUserId($user->id, 'Approved');
        $rejectedPlace = $this->placeService->getRejectedPlaceByUserId($user->id, 'Rejected');
        $reviews = $this->reviewService->getReviewByUserId($user->id);
        return view('front.contributor.profile', compact('user', 'pendingPlace', 'approvedPlace', 'rejectedPlace', 'reviews'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
