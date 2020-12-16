<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewirePieChart;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;

class LivewirePieChartTest extends TestCase
{
    private function buildComponent() : TestableLivewire
    {
        return Livewire::test(LivewirePieChart::class);
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
