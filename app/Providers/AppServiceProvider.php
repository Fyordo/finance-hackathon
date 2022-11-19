<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\Role;
use App\Models\RoleRight;
use App\Observers\CurrencyObserver;
use App\Observers\RoleObserver;
use App\Observers\RoleRightObserver;
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
        $this->app->register(RoleServiceProvider::class);
        $this->app->register(RoleRightServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
        $this->app->register(CurrencyServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Role::observe(RoleObserver::class);
        RoleRight::observe(RoleRightObserver::class);
        Currency::observe(CurrencyObserver::class);
    }
}
