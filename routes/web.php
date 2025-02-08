<?php

use App\Http\Controllers\Contributor\PlaceController;
use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\FrontController;
use \App\Http\Controllers\ApiController;
use App\Http\Middleware\EnsureIsAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureIsAuthenticated::class)->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');

    Route::get('/search', [ApiController::class, 'searchPlaces'])->name('search');
    Route::get('/place-detail/id/{placeId}', [ApiController::class, 'placeDetails'])->name('api.place.details');

    Route::get('/contrib/add-place', [PlaceController::class, 'addPlaceView'])->name('contrib.place.add');
    Route::post('/contrib/add-place', [PlaceController::class, 'createPlace'])->name('contrib.place.create');
//    Route::get('/search/autocomplete', \App\Livewire\LocationSearchAutocomplete::class);
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/admin/category/{category:slug}', [])

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
