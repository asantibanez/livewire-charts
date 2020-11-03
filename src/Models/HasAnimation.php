<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasAnimation
{
    private $animated;

    public function setAnimated($animated)
    {
        $this->animated = $animated;

        return $this;
    }

    protected function initAnimation()
    {
        $this->animated = $this->defaultAnimated();
    }

    private function defaultAnimated()
    {
        return false;
    }

    protected function animationFromArray($array)
    {
        $this->animated = data_get($array, 'animated', $this->defaultAnimated());
    }

    protected function animationToArray()
    {
        return [
            'animated' => $this->animated,
        ];
    }
}
