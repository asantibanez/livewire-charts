<?php

namespace Asantibanez\LivewireCharts\Charts;

use Asantibanez\LivewireCharts\Models\CombinationChartModel;
use Livewire\Component;

/**
 * Class LivewireCombinationChart
 * @package Asantibanez\LivewireCharts\Charts
 */
class LivewireCombinationChart extends Component
{
    public $combinationChartModel;

    public function mount(CombinationChartModel $combinationChartModel)
    {
        $this->combinationChartModel = $combinationChartModel->toArray();
    }

    public function onColumnClick($column)
    {
        $onColumnClickEventName = data_get($this->combinationChartModel, 'onColumnClickEventName', null);

        if ($onColumnClickEventName === null) {
            return;
        }

        $this->dispatch($onColumnClickEventName, $column);
    }

    public function render()
    {
        return view('livewire-charts::livewire-combination-chart');
    }
}
