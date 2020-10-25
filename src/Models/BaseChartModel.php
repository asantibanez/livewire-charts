<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class BaseChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class BaseChartModel
{
    use HasAxisConfiguration;
    use HasStrokeConfiguration;

    public function __construct()
    {
        $this->setupAxis();
    }

    public function reactiveKey()
    {
        return md5(json_encode($this->toArray()));
    }

    public function toArray()
    {
        return [
            'xAxis' => $this->xAxis,
            'yAxis' => $this->yAxis,
            'stroke' => $this->stroke,
        ];
    }

    public function fromArray($array)
    {
        $this->setupAxis($array);
        $this->setupStroke($array);
    }
}
