<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class ColumnChartModel
 * @package Asantibanez\LivewireCharts\Models
 * @property boolean $isMultiColumn
 * @property boolean $isStacked
 */
class RadarChartModel extends BaseChartModel
{
    public $opacity;

    public $colors;

    public $onPointClickEventName;

    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->onPointClickEventName = null;

        $this->opacity = 0.5;

        $this->colors = ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800'];

        $this->data = collect();
    }

    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }

    public function setOpacity($opacity)
    {
        $this->opacity = $opacity;

        return $this;
    }

    public function withOnPointClickEvent($onPointClickEventName)
    {
        $this->onPointClickEventName = $onPointClickEventName;

        return $this;
    }


    public function addSeries($seriesName, $title, $value, $extras = [])
    {
        $series = $this->data->get($seriesName, collect());

        $series->push([
            'seriesName' => $seriesName,
            'title' => $title,
            'value' => $value,
            'extras' => $extras,
        ]);

        $this->data->put($seriesName, $series);

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'onPointClickEventName' => $this->onPointClickEventName,
            'opacity' => $this->opacity,
            'colors' => $this->colors,
            'data' => $this->data->toArray(),
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->onPointClickEventName = data_get($array, 'onPointClickEventName', null);

        $this->opacity = data_get($array, 'opacity', 0.5);

        $this->colors = data_get($array, 'color', '#90cdf4');

        $this->data = collect(data_get($array, 'data', []));
    }
}
