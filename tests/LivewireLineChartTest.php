<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewireLineChart;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;

class LivewireLineChartTest extends TestCase
{
    private function buildComponent() : TestableLivewire
    {
        return Livewire::test(LivewireLineChart::class);
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
