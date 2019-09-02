<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Fagged_Incident;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->share('flaggedIncidentsCount', Fagged_Incident::count());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
