<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasColors
{
    private $colors;

    private $enableShades;

    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }

    public function addColor($color)
    {
        $this->colors[] = $color;

        return $this;
    }

    public function enableShades()
    {
        $this->enableShades = true;

        return $this;
    }

    public function disableShades()
    {
        $this->enableShades = false;

        return $this;
    }

    protected function initColors()
    {
        $this->colors = $this->defaultColors();

        $this->enableShades = true;
    }

    private function defaultColors()
    {
        return [];
    }

    protected function colorsFromArray($array)
    {
        $this->colors = data_get($array, 'colors', $this->defaultColors());

        $this->enableShades = data_get($array, 'enableShades', true);
    }

    protected function colorsToArray()
    {
        return [
            'colors' => $this->colors,
            'enableShades' => $this->enableShades,
        ];
    }
}
