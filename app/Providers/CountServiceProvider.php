<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CountComposer;

class CountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer('myprofile.left', CountComposer::class);
    }
}
