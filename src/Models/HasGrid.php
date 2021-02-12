<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasGrid
{
    private $grid;

    public function setGridVisible($visible)
    {
        data_set($this->grid, 'show', $visible);

        return $this;
    }

    public function withGrid()
    {
        data_set($this->grid, 'show', true);

        return $this;
    }

    public function withoutGrid()
    {
        data_set($this->grid, 'show', false);

        return $this;
    }

    protected function initGrid()
    {
        $this->grid = $this->defaultGrid();
    }

    private function defaultGrid()
    {
        return [
            'show' => false,
            'position' => 'back',
            'xaxis' => [
                'lines' => [
                    'show' => true,
                ],
            ],
            'yaxis' => [
                'lines' => [
                    'show' => true,
                ],
            ],
        ];
    }

    protected function gridFromArray($array)
    {
        $this->grid = data_get($array, 'grid', $this->defaultGrid());
    }

    protected function gridToArray()
    {
        return [
            'grid' => $this->grid,
        ];
    }
}
