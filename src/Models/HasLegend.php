<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasLegend
{
    private $legend;

    public function initLegend()
    {
        $this->legend = $this->defaultLegend();
    }

    private function defaultLegend()
    {
        return [
            'show' => true,
            'position' => 'bottom',
            'horizontalAlign' => 'center',
        ];
    }

    public function setLegendVisibility($visible)
    {
        data_set($this->legend, 'show', $visible);

        return $this;
    }

    protected function legendToArray()
    {
        return [
            'legend' => $this->legend,
        ];
    }

    protected function legendFromArray($array)
    {
        $this->legend = data_get($array, 'legend', $this->defaultLegend());
    }
}
