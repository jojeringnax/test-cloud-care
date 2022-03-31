<?php

namespace App\Providers;

use App\Http\Requests\PunkAPIClient;
use Illuminate\Support\ServiceProvider;

class PunkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(PunkAPIClient::class, fn() => new PunkAPIClient());
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
