<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewireColumnChart;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

class LivewireColumnChartTest extends TestCase
{
    private function buildComponent() : Testable
    {
        return Livewire::test(LivewireColumnChart::class);
    }

    /** @test */
    public function can_build_component()
    {
        //Act
        $component = $this->buildComponent();

        //Assert
        $this->assertNotNull($component);
    }
}
