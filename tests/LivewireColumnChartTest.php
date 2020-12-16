<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewireColumnChart;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;

class LivewireColumnChartTest extends TestCase
{
    private function buildComponent() : TestableLivewire
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
