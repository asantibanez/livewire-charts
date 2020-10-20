<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasAxisConfiguration
{
    private $xAxis;

    private $yAxis;

    public function setXAxisVisible($visible)
    {
        data_set($this->xAxis, 'labels.show', $visible);

        return $this;
    }

    public function setYAxisVisible($visible)
    {
        data_set($this->yAxis, 'show', $visible);

        return $this;
    }

    protected function setupAxis($array = [])
    {
        $this->xAxis = data_get($array, 'xAxis', $this->defaultXAxis());

        $this->yAxis = data_get($array, 'yAxis', $this->defaultYAxis());
    }

    private function defaultXAxis()
    {
        return [
            'labels' => [
                'show' => true,
            ],
        ];
    }

    private function defaultYAxis()
    {
        return [
            'show' => true,
        ];
    }
}
