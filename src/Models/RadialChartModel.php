<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class RadialChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class RadialChartModel extends BaseChartModel
{
    public $data;
    public $showTotal;
    public $onBarClickEventName;

    public function __construct()
    {
        parent::__construct();

        $this->data = collect();

        $this->showTotal = true;
    }

    public function showTotal(): self
    {
        $this->showTotal = true;
        return $this;
    }

    public function hideTotal(): self
    {
        $this->showTotal = false;
        return $this;
    }

    public function addBar($title, $value, $color = null, $extras = []): self
    {
        $this->data->push([
            'title' => $title,
            'value' => $value,
            'extras' => $extras,
        ]);

        $this->addColor($color);

        return $this;
    }

    public function withOnBarClickEvent($onBarClickEvent): self
    {
        $this->onBarClickEventName = $onBarClickEvent;

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'data' => $this->data->toArray(),
            'showTotal' => $this->showTotal,
            'onBarClickEventName' => $this->onBarClickEventName,
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->data = collect(data_get($array, 'data', []));

        $this->showTotal = data_get($array, 'showTotal', true);

        $this->onBarClickEventName = data_get($array, 'onBarClickEventName', null);
    }
}
