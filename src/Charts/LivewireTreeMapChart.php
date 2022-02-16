<?php

namespace Asantibanez\LivewireCharts\Charts;

use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Livewire\Component;

/**
 * Class LivewireTreeMapChart
 * @package Asantibanez\LivewireCharts\Charts
 */
class LivewireTreeMapChart extends Component
{
    public $treeMapChartModel;

    public function mount(TreeMapChartModel $treeMapChartModel)
    {
        $this->treeMapChartModel = $treeMapChartModel->toArray();
    }

    public function render()
    {
        return view('livewire-charts::livewire-tree-map-chart');
    }
}
