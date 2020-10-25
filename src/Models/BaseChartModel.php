<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class BaseChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class BaseChartModel
{
    use HasAxis;
    use HasStroke;
    use HasLegend;

    public function __construct()
    {
        $this->initAxis();
        $this->initStroke();
        $this->initLegend();
    }

    public function reactiveKey()
    {
        return md5(json_encode($this->toArray()));
    }

    public function toArray()
    {
        return array_merge(
            $this->axisToArray(),
            $this->strokeToArray(),
            $this->legendToArray()
        );
    }

    public function fromArray($array)
    {
        $this->axisFromArray($array);
        $this->strokeFromArray($array);
        $this->legendFromArray($array);
    }
}
