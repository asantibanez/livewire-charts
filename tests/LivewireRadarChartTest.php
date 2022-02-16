<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewireRadarChart;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;

class LivewireRadarChartTest extends TestCase
{
    private function buildComponent() : TestableLivewire
    {
        return Livewire::test(LivewireRadarChart::class);
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
