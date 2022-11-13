<?php

namespace App\Providers;

use App\Contracts\CompanyInterface;
use App\Services\CompanyServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCompany();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function registerCompany()
    {
        return $this->app->bind(CompanyInterface::class, CompanyServices::class);
    }
}
