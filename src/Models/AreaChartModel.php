<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class AreaChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class AreaChartModel extends BaseChartModel
{
    public $title;

    public $color;

    public $data;

    public $onPointClickEventName;

    public function __construct()
    {
        parent::__construct();

        $this->title = '';

        $this->color = '#90cdf4';

        $this->onPointClickEventName = null;

        $this->data = collect();
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;

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

    public function withOnPointClickEvent($onPointClickEventName)
    {
        $this->onPointClickEventName = $onPointClickEventName;

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'title' => $this->title,
            'color' => $this->color,
            'onPointClickEventName' => $this->onPointClickEventName,
            'data' => $this->data->toArray(),
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->title = data_get($array, 'title', '');

        $this->color = data_get($array, 'color', '#90cdf4');

        $this->onPointClickEventName = data_get($array, 'onPointClickEventName', null);

        $this->data = collect(data_get($array, 'data', []));
    }
}
