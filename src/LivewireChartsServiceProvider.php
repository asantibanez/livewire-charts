<?php

namespace Asantibanez\LivewireCharts;

use Asantibanez\LivewireCharts\Charts\LivewireColumnChart;
use Asantibanez\LivewireCharts\Charts\LivewireLineChart;
use Asantibanez\LivewireCharts\Charts\LivewirePieChart;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireChartsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-charts');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-charts'),
            ], 'livewire-charts-views');
        }

        Livewire::component('livewire-line-chart', LivewireLineChart::class);
        Livewire::component('livewire-column-chart', LivewireColumnChart::class);
        Livewire::component('livewire-pie-chart', LivewirePieChart::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
