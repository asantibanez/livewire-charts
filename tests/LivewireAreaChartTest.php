<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewireAreaChart;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;

class LivewireAreaChartTest extends TestCase
{
    private function buildComponent() : TestableLivewire
    {
        return Livewire::test(LivewireAreaChart::class);
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
