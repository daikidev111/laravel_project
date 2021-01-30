<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AccountRepository;
use App\Repositories\EloquentAccount;
class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->app->singleton(AccountRepository::class, EloquentAccount::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
