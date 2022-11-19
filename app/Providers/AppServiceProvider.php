<?php

namespace App\Providers;

use App\Facades\AccountManager;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Operation;
use App\Models\Role;
use App\Models\RoleRight;
use App\Observers\AccountObserver;
use App\Observers\CurrencyObserver;
use App\Observers\OperationObserver;
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
        $this->app->register(AccountServiceProvider::class);
        $this->app->register(OperationServiceProvider::class);
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
        Account::observe(AccountObserver::class);
        Operation::observe(OperationObserver::class);
    }
}
