<?php

namespace Bbsnly\ChartJs;

use Bbsnly\ChartJs\Chart;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(Chart::class, function ($app) {
            return new Chart();
        });
    }
}
