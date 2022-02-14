<?php

namespace Asantibanez\LivewireCharts\Facades;

use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Illuminate\Support\Facades\Facade;

/**
 * Class LivewireCharts
 * @package Asantibanez\LivewireCharts\Facades
 * @method static LineChartModel lineChartModel()
 * @method static LineChartModel multiLineChartModel()
 * @method static ColumnChartModel columnChartModel()
 * @method static ColumnChartModel multiColumnChartModel()
 * @method static AreaChartModel areaChartModel()
 * @method static PieChartModel pieChartModel()
 * @method static RadarChartModel radarChartModel()
 * @method static TreeMapChartModel treeMapChartModel()
 */
class LivewireCharts extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewirecharts';
    }
}
