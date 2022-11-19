<?php

namespace App\Providers;

use App\Facades\RoleRightManager;
use App\Services\RoleRightService;
use Illuminate\Support\ServiceProvider;

class RoleRightServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleRightManager::class, RoleRightService::class);
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
