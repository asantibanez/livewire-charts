<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasAxis
{
    private $xAxis;

    private $yAxis;

    protected function initAxis()
    {
        $this->xAxis = $this->defaultXAxis();
        $this->yAxis = $this->defaultYAxis();
    }

    private function defaultXAxis()
    {
        return [
            'categories' => [],
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

    public function setXAxisVisible($visible)
    {
        data_set($this->xAxis, 'labels.show', $visible);

        return $this;
    }

    public function setXAxisCategories($categories = [])
    {
        data_set($this->xAxis, 'categories', $categories);

        return $this;
    }

    public function setYAxisVisible($visible)
    {
        data_set($this->yAxis, 'show', $visible);

        return $this;
    }

    protected function axisFromArray($array)
    {
        $this->xAxis = data_get($array, 'xAxis', $this->defaultXAxis());

        $this->yAxis = data_get($array, 'yAxis', $this->defaultYAxis());
    }

    protected function axisToArray()
    {
        return [
            'xAxis' => $this->xAxis,
            'yAxis' => $this->yAxis,
        ];
    }
}
