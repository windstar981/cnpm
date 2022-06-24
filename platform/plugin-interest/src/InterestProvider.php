<?php

namespace Tool\PluginInterest;

use Illuminate\Support\ServiceProvider;

class InterestProvider extends ServiceProvider
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
        //
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views','plugin-interest');
    }
}
