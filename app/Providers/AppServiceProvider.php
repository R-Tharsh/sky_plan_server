<?php

namespace App\Providers;

use App\Repositories\AirportDetailRepository;
use App\Repositories\AirportDetailRepositoryInterface;
use App\Repositories\FlightRepositoryInterface;
use App\Repositories\FlightRepository;
use App\Services\FlightServiceInterface;
use App\Services\FlightService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Ensure the repository interface is bound to its implementation
        $this->app->bind(AirportDetailRepositoryInterface::class, AirportDetailRepository::class);
        $this->app->bind(FlightRepositoryInterface::class, FlightRepository::class);

        // Ensure the service interface is bound to its implementation
        $this->app->bind(FlightServiceInterface::class, FlightService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
