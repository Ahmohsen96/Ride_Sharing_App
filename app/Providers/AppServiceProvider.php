<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\TripRepository;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\TripRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() {
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
