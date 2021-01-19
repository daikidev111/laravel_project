<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AddressRepository;
use App\Repositories\EloquentAddress;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->app->singleton(AddressRepository::class, EloquentAddress::class);
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
