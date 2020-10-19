<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class PieChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class PieChartModel
{
    public $title;

    public $animated;

    public $onSliceClickEventName;

    public $opacity;

    public $data;

    public function __construct()
    {
        $this->title = '';

        $this->animated = false;

        $this->onSliceClickEventName = null;

        $this->opacity = 0.75;

        $this->data = collect();
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setAnimated($animated)
    {
        $this->animated = $animated;

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
        return [
            'title' => $this->title,
            'animated' => $this->animated,
            'onSliceClickEventName' => $this->onSliceClickEventName,
            'opacity' => $this->opacity,
            'data' => $this->data->toArray(),
        ];
    }

    public function fromArray($array)
    {
        $this->title = data_get($array, 'title', '');

        $this->animated = data_get($array, 'animated', false);

        $this->onSliceClickEventName = data_get($array, 'onSliceClickEventName', null);

        $this->opacity = data_get($array, 'opacity', 0.75);

        $this->data = collect(data_get($array, 'data', []));
    }

    public function reactiveKey()
    {
        return md5(json_encode($this->toArray()));
    }
}
