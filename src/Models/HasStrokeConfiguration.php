<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasStrokeConfiguration
{
    private $stroke;

    public function __construct()
    {
        $this->stroke = $this->defaultStroke();
    }

    public function setSmoothCurve()
    {
        data_set($this->stroke, 'curve', 'smooth');

        return $this;
    }

    public function setStraightCurve()
    {
        data_set($this->stroke, 'curve', 'straight');

        return $this;
    }

    protected function setupStroke($array = [])
    {
        $this->stroke = data_get($array, 'stroke', $this->defaultStroke());
    }

    private function defaultStroke()
    {
        return [
            'curve' => 'straight',
        ];
    }
}
