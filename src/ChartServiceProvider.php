<?php

namespace Bbsnly\ChartJs;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ChartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('chartjs', function ($expression) {
            return "<?php echo app(\Bbsnly\ChartJs\Chart::class)->toHtml($expression); ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Chart::class, function ($app) {
            return new Chart();
        });
    }
}
