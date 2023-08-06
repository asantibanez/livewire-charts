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

    /** @test */
    public function should_emit_event_if_present()
    {
        //Arrange
        $component = $this->buildComponent();

        $columnChartModel = $component->columnChartModel;

        data_set($columnChartModel, 'onColumnClickEventName', 'custom-event');

        $component->set('columnChartModel', $columnChartModel);

        //Act
        $component->runAction('onColumnClick', []);

        //Assert
        $component->assertDispatched('custom-event');
    }
}
