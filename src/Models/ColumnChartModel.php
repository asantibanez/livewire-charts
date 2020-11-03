<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class ColumnChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class ColumnChartModel extends BaseChartModel
{
    public $title;

    public $opacity;

    public $onColumnClickEventName;

    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->title = '';

        $this->onColumnClickEventName = null;

        $this->opacity = 0.5;

        $this->data = collect();
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setOpacity($opacity)
    {
        $this->opacity = $opacity;

        return $this;
    }

    public function withOnColumnClickEventName($onColumnClickEventName)
    {
        $this->onColumnClickEventName = $onColumnClickEventName;

        return $this;
    }

    public function addColumn($title, $value, $color, $extras = [])
    {
        $this->data->push([
            'title' => $title,
            'value' => $value,
            'color' => $color,
            'extras' => $extras,
        ]);

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'title' => $this->title,
            'onColumnClickEventName' => $this->onColumnClickEventName,
            'opacity' => $this->opacity,
            'data' => $this->data->toArray(),
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->title = data_get($array, 'title', '');

        $this->onColumnClickEventName = data_get($array, 'onColumnClickEventName', null);

        $this->opacity = data_get($array, 'opacity', 0.5);

        $this->data = collect(data_get($array, 'data', []));
    }
}
