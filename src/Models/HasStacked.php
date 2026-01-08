<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasStacked
{
    private $stacked = false;

    public function setStacked($stacked)
    {
        $this->stacked = $stacked;

        return $this;
    }

    protected function stackedFromArray($array)
    {
        $this->stacked = data_get($array, 'stacked', false);
    }

    protected function stackedToArray()
    {
        return [
            'stacked' => $this->stacked,
        ];
    }
}
