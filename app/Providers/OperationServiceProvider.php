<?php

namespace App\Providers;

use App\Facades\OperationManager;
use App\Services\OperationService;
use Illuminate\Support\ServiceProvider;

class OperationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OperationManager::class, OperationService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
