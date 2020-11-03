<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class PieChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class PieChartModel extends BaseChartModel
{
    public $title;

    public $onSliceClickEventName;

    public $opacity;

    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->title = '';

        $this->onSliceClickEventName = null;

        $this->opacity = 0.75;

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

    public function withOnSliceClickEvent($onSliceClickEventName)
    {
        $this->onSliceClickEventName = $onSliceClickEventName;

        return $this;
    }

    public function addSlice($title, $value, $color, $extras = [])
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
            'onSliceClickEventName' => $this->onSliceClickEventName,
            'opacity' => $this->opacity,
            'data' => $this->data->toArray(),
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->title = data_get($array, 'title', '');

        $this->onSliceClickEventName = data_get($array, 'onSliceClickEventName', null);

        $this->opacity = data_get($array, 'opacity', 0.75);

        $this->data = collect(data_get($array, 'data', []));
    }
}
