<?php

namespace Asantibanez\LivewireCharts\Charts;

use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

/**
 * Class PieChart
 * @package Asantibanez\LivewireCharts\Charts
 */
class LivewirePieChart extends Component
{
    public $pieChartModel;

    public function mount(PieChartModel $pieChartModel)
    {
        $this->pieChartModel = $pieChartModel->toArray();
    }

    public function onSliceClick($slice)
    {
        $onSliceClickEventName = data_get($this->pieChartModel, 'onSliceClickEventName', null);

        if ($onSliceClickEventName === null) {
            return;
        }

        $this->dispatch($onSliceClickEventName, $slice);
    }

    public function render()
    {
        return view('livewire-charts::livewire-pie-chart');
    }
}
