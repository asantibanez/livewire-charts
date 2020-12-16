<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\LivewireChartsServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LivewireChartsServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
    }

}
