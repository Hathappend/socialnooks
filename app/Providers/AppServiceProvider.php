<?php

namespace App\Providers;

use App\Repositories\ApiRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\ApiRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PlaceRepositoryInterface;
use App\Repositories\PlaceRepository;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiRepositoryInterface::class, ApiRepository::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(PlaceRepositoryInterface::class, PlaceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Livewire::forceAssetInjection();
    }
}
