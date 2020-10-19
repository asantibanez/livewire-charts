<?php

namespace Asantibanez\LivewireCharts\Tests;

use Orchestra\Testbench\TestCase;
use Asantibanez\LivewireCharts\LivewireChartsServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LivewireChartsServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
