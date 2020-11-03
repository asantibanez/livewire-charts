<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class BaseChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class BaseChartModel
{
    use HasTitle;
    use HasAnimation;
    use HasAxis;
    use HasStroke;
    use HasLegend;
    use HasDataLabels;

    public function __construct()
    {
        $this->initTitle();
        $this->initAnimation();
        $this->initAxis();
        $this->initStroke();
        $this->initLegend();
        $this->initDataLabels();
    }

    public function reactiveKey()
    {
        return md5(json_encode($this->toArray()));
    }

    public function toArray()
    {
        return array_merge(
            $this->titleToArray(),
            $this->animationToArray(),
            $this->axisToArray(),
            $this->strokeToArray(),
            $this->legendToArray(),
            $this->dataLabelsToArray()
        );
    }

    public function fromArray($array)
    {
        $this->titleFromArray($array);
        $this->animationFromArray($array);
        $this->axisFromArray($array);
        $this->strokeFromArray($array);
        $this->legendFromArray($array);
        $this->dataLabelsFromArray($array);
    }
}
