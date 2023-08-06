<?php

namespace Asantibanez\LivewireCharts\Charts;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\Component;

/**
 * Class LivewireColumnChart
 * @package Asantibanez\LivewireCharts\Charts
 */
class LivewireColumnChart extends Component
{
    public $columnChartModel;

    public function mount(ColumnChartModel $columnChartModel)
    {
        $this->columnChartModel = $columnChartModel->toArray();
    }

    public function onColumnClick($column)
    {
        $onColumnClickEventName = data_get($this->columnChartModel, 'onColumnClickEventName', null);

        if ($onColumnClickEventName === null) {
            return;
        }

        $this->dispatch($onColumnClickEventName, $column);
    }

    public function render()
    {
        if ($this->columnChartModel['isMultiColumn']) {
            return view('livewire-charts::livewire-multi-column-chart');
        }

        return view('livewire-charts::livewire-column-chart');
    }
}
