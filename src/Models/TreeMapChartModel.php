<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class TreeMapChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class TreeMapChartModel extends BaseChartModel
{
    use HasTitle;
    use HasColors;

    public $data;
    public $distributed;
    public $onBlockClickEventName;

    public function __construct()
    {
        parent::__construct();

        $this->data = collect();

        $this->distributed = false;

        $this->setColors(['#2E93fA']);
    }

    public function setDistributed($distributed)
    {
        $this->distributed = $distributed;

        return $this;
    }

    public function addBlock($title, $value, $extras = [])
    {
        return $this->addSeriesBlock($this->title, $title, $value, $extras);
    }

    public function addSeriesBlock($seriesName, $title, $value, $extras = [])
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

    public function withOnBlockClickEvent($onBlockClickEventName)
    {
        $this->onBlockClickEventName = $onBlockClickEventName;

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'data' => $this->data->toArray(),
            'distributed' => $this->distributed,
            'onBlockClickEventName' => $this->onBlockClickEventName,
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->data = collect(data_get($array, 'data', []));

        $this->distributed = data_get($array, 'distributed', false);

        $this->onBlockClickEventName = data_get($array, 'onBlockClickEventName', null);
    }
}
