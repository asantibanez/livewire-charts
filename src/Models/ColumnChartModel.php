<?php


namespace Asantibanez\LivewireCharts\Models;

/**
 * Class ColumnChartModel
 * @package Asantibanez\LivewireCharts\Models
 * @property boolean $isMultiColumn
 * @property boolean $isStacked
 */
class ColumnChartModel extends BaseChartModel
{
    private $opacity;

    private $columnWidth;

    private $horizontal;

    private $isMultiColumn;

    private $isStacked;

    private $onColumnClickEventName;

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->onColumnClickEventName = null;

        $this->opacity = 0.75;

        $this->columnWidth = 70;

        $this->horizontal = false;

        $this->isMultiColumn = false;

        $this->isStacked = false;

        $this->data = collect();
    }

    public function multiColumn()
    {
        $this->isMultiColumn = true;

        return $this;
    }

    public function singleColumn()
    {
        $this->isMultiColumn = false;

        return $this;
    }

    public function stacked()
    {
        $this->isStacked = true;

        return $this;
    }

    public function setHorizontal()
    {
        $this->horizontal = true;

        return $this;
    }

    public function setVertical()
    {
        $this->horizontal = false;

        return $this;
    }

    public function setColumnWidth($value)
    {
        $this->columnWidth = $value;

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

    public function addSeriesColumn($seriesName, $title, $value, $extras = [])
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
            'onColumnClickEventName' => $this->onColumnClickEventName,
            'opacity' => $this->opacity,
            'horizontal' => $this->horizontal,
            'columnWidth' => $this->columnWidth,
            'isMultiColumn' => $this->isMultiColumn,
            'isStacked' => $this->isStacked,
            'data' => $this->data->toArray(),
        ]);
    }

    public function fromArray($array)
    {
        parent::fromArray($array);

        $this->onColumnClickEventName = data_get($array, 'onColumnClickEventName', null);

        $this->opacity = data_get($array, 'opacity', 0.5);

        $this->columnWidth = data_get($array, 'columnWidth', 70);

        $this->horizontal = data_get($array, 'horizontal', false);

        $this->isMultiColumn = data_get($array, 'isMultiColumn', false);

        $this->isStacked = data_get($array, 'isStacked', false);

        $this->data = collect(data_get($array, 'data', []));
    }
}
