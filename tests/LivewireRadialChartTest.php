<?php


use Asantibanez\LivewireCharts\Charts\LivewireRadialChart;
use Asantibanez\LivewireCharts\Tests\TestCase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

class LivewireRadialChartTest extends TestCase
{
    private function buildComponent() : Testable
    {
        return Livewire::test(LivewireRadialChart::class);
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

        $radialChartModel = $component->radialChartModel;

        data_set($radialChartModel, 'onBarClickEventName', 'custom-event');

        $component->set('radialChartModel', $radialChartModel);

        //Act
        $component->runAction('onBarClick', []);

        //Assert
        $component->assertDispatched('custom-event');
    }
}
