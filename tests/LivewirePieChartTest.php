<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Charts\LivewirePieChart;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

class LivewirePieChartTest extends TestCase
{
    private function buildComponent() : Testable
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
