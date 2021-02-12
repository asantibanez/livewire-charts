<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasColors
{
    private $colors;

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

    protected function initColors()
    {
        $this->colors = $this->defaultColors();
    }

    private function defaultColors()
    {
        return [];
    }

    protected function colorsFromArray($array)
    {
        $this->colors = data_get($array, 'colors', $this->defaultColors());
    }

    protected function colorsToArray()
    {
        return [
            'colors' => $this->colors,
        ];
    }
}
