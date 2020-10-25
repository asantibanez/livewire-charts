<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class LineChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class LineChartModel extends BaseChartModel
{
    public $title;

    public $animated;

    public $data;

    public $markers;

    public $onPointClickEventName;

    public function __construct()
    {
        parent::__construct();

        $this->title = '';

        $this->animated = false;

        $this->onPointClickEventName = null;

        $this->data = collect();

        $this->markers = collect();
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

    public function addPoint($title, $value, $extras = [])
    {
        $this->data->push([
            'title' => $title,
            'value' => $value,
            'extras' => $extras,
        ]);

        return $this;
    }

    public function addMarker($title,
                              $value,
                              $strokeColor = 'green',
                              $text = '',
                              $textColor = '#ffffff',
                              $textBackgroundColor = '#cccccc')
    {
        $this->markers->push([
            'title' => $title,
            'value' => $value,
            'strokeColor' => $strokeColor,
            'text' => $text,
            'textColor' => $textColor,
            'textBackgroundColor' => $textBackgroundColor,
        ]);

        return $this;
    }

    public function withOnPointClickEvent($onPointClickEventName)
    {
        $this->onPointClickEventName = $onPointClickEventName;

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'title' => $this->title,
            'animated' => $this->animated,
            'onPointClickEventName' => $this->onPointClickEventName,
            'data' => $this->data->toArray(),
            'markers' => $this->markers->toArray(),
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->title = data_get($array, 'title', '');

        $this->animated = data_get($array, 'animated', false);

        $this->onPointClickEventName = data_get($array, 'onPointClickEventName', null);

        $this->data = collect(data_get($array, 'data', []));

        $this->markers = collect(data_get($array, 'markers', []));
    }

    public function reactiveKey()
    {
        return md5(json_encode($this->toArray()));
    }
}
