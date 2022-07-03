<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasDataLabels
{
    private $dataLabels;

    public function setDataLabelsEnabled($enabled)
    {
        $this->dataLabels = $enabled;

        return $this;
    }

    public function withDataLabels()
    {
        $this->dataLabels = true;

        return $this;
    }

    public function withoutDataLabels()
    {
        $this->dataLabels = false;

        return $this;
    }

    protected function initDataLabels()
    {
        $this->dataLabels = $this->defaultDataLabels();
    }

    private function defaultDataLabels()
    {
        return false;
    }

    protected function dataLabelsFromArray($array)
    {
        $this->dataLabels = data_get($array, 'dataLabels', $this->defaultDataLabels());
    }

    protected function dataLabelsToArray()
    {
        return [
            'dataLabels' => $this->dataLabels,
        ];
    }
}
