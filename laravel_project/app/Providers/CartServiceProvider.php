<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CartRepository;
use App\Repositories\EloquentCart;
class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(CartRepository::class, EloquentCart::class);
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
