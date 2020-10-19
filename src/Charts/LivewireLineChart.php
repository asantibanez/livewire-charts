<?php

namespace Asantibanez\LivewireCharts\Charts;

use Asantibanez\LivewireCharts\Models\LineChartModel;
use Livewire\Component;

/**
 * Class LivewireLineChart
 * @package Asantibanez\LivewireCharts\Charts
 */
class LivewireLineChart extends Component
{
    public $lineChartModel;

    public function mount(LineChartModel $lineChartModel)
    {
        $this->lineChartModel = $lineChartModel->toArray();
    }

    public function onPointClick($point)
    {
        $onPointClickEventName = data_get($this->lineChartModel, 'onPointClickEventName', null);

        if ($onPointClickEventName === null) {
            return;
        }

        $this->emit($onPointClickEventName, $point);
    }

    public function render()
    {
        return view('livewire-charts::livewire-line-chart');
    }
}
