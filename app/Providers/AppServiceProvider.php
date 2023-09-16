<?php

namespace App\Providers;

use App\Facades\EmployeeFacade;
use App\Repositories\EmployeeRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Services\EmployeeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Facades
        EmployeeFacade::shouldProxyTo(EmployeeService::class);

        //Repositories
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
