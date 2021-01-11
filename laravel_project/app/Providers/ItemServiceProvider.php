<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ItemRepository;
use App\Repositories\EloquentItem;

class ItemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->app->singleton(ItemRepository::class, EloquentItem::class);
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
