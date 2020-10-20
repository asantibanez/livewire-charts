<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class BaseChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class BaseChartModel
{
    use HasAxisConfiguration;

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
        ];
    }

    public function fromArray($array)
    {
        $this->setupAxis($array);
    }
}
