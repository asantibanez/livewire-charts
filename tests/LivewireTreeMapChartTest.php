<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewireTreeMapChart;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

class LivewireTreeMapChartTest extends TestCase
{
    private function buildComponent() : Testable
    {
        return Livewire::test(LivewireTreeMapChart::class);
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
