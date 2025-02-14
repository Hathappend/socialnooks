<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Contributor\PlaceController;
use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\FrontController;
use \App\Http\Controllers\ApiController;
use App\Http\Middleware\EnsureIsAuthenticated;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureIsAuthenticated::class)->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/about', [FrontController::class, 'about'])->name('front.about');

    Route::get('/search', [ApiController::class, 'searchPlaces'])->name('search');
    Route::get('/place-detail/id/{placeId}', [ApiController::class, 'placeDetails'])->name('api.place.details');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/{category:slug}', [CategoryController::class, 'detail'])->name('category.details');

    Route::middleware('auth')->group(function () {
        Route::get('/contrib/add-place', [PlaceController::class, 'addPlaceView'])->name('contrib.place.add');
        Route::post('/contrib/add-place', [PlaceController::class, 'createPlace'])->name('contrib.place.create');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');




require __DIR__.'/auth.php';
