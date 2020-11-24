<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasStroke
{
    private $stroke;
    private $width;

    public function initStroke()
    {
        $this->stroke = $this->defaultStroke();
    }

    private function defaultStroke()
    {
        return [
            'curve' => 'straight',
            'width' => 4
        ];
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

    public function setStrokeWidth($width)
    {
        data_set($this->stroke, 'width', $width);

        return $this;
    }

    protected function strokeToArray()
    {
        return [
            'stroke' => $this->stroke,
        ];
    }

    protected function strokeFromArray($array)
    {
        $this->stroke = data_get($array, 'stroke', $this->defaultStroke());
    }
}
