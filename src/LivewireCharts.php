<?php


namespace Asantibanez\LivewireCharts;


use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

class LivewireCharts
{
    public function lineChartModel()
    {
        return (new LineChartModel)
            ->singleLine();
    }

    public function multiLineChartModel()
    {
        return (new LineChartModel)
            ->multiLine();
    }

    public function columnChartModel()
    {
        return (new ColumnChartModel)
            ->singleColumn();
    }

    public function multiColumnChartModel()
    {
        return (new ColumnChartModel)
            ->multiColumn();
    }

    public function areaChartModel()
    {
        return new AreaChartModel;
    }

    public function pieChartModel()
    {
        return new PieChartModel;
    }

    public function radarChartModel()
    {
        return new RadarChartModel();
    }

    public function treeMapChartModel()
    {
        return new TreeMapChartModel();
    }
}
