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
    use HasSparkline;
    use HasGrid;
    use HasColors;
    use HasJsonConfig;

    public function __construct()
    {
        $this->initTitle();
        $this->initAnimation();
        $this->initAxis();
        $this->initStroke();
        $this->initLegend();
        $this->initDataLabels();
        $this->initSparkline();
        $this->initGrid();
        $this->initColors();
        $this->initJsonConfig();
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
            $this->dataLabelsToArray(),
            $this->sparklineToArray(),
            $this->gridToArray(),
            $this->colorsToArray(),
            $this->jsonConfigToArray()
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
        $this->sparklineFromArray($array);
        $this->gridFromArray($array);
        $this->colorsFromArray($array);
        $this->jsonConfigFromArray($array);
    }
}
