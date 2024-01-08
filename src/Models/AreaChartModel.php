<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class AreaChartModel
 * @package Asantibanez\LivewireCharts\Models
 */
class AreaChartModel extends BaseChartModel
{
    use HasStacked;

    public $data;

    public $onPointClickEventName;

    public function __construct()
    {
        parent::__construct();

        $this->onPointClickEventName = null;

        $this->data = collect();

        $this->setColors(['#90cdf4']);
    }

    public function addPoint($title, $value, $extras = [])
    {
        return $this->addSeriesPoint($this->getTitle(), $title, $value, $extras);
    }

    public function addSeriesPoint($seriesName, $title, $value, $extras = [])
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

    public function withOnPointClickEvent($onPointClickEventName)
    {
        $this->onPointClickEventName = $onPointClickEventName;

        return $this;
    }

    public function toArray()
    {
        return array_merge(
            parent::toArray(),
            $this->stackedToArray(),
            [
                'onPointClickEventName' => $this->onPointClickEventName,
                'data' => $this->data->toArray(),
            ],
        );
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->stackedFromArray($array);

        $this->onPointClickEventName = data_get($array, 'onPointClickEventName', null);

        $this->data = collect(data_get($array, 'data', []));
    }
}
