<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Employee\EmployeeRepositoryInterface::class, \App\Repositories\Employee\EmployeeRepository::class);
        $this->app->bind(\App\Repositories\Division\DivisionRepositoryInterface::class, \App\Repositories\Division\DivisionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
