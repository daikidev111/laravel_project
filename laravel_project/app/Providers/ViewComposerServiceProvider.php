<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\AuthComposer;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
	public function boot()
	{
		View::composer(['account.*', 'admin.account.index'], AuthComposer::class);
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
