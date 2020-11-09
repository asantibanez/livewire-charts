<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasSparkline
{
    private $sparkline;

    public function setSparklineEnabled($isEnabled)
    {
        data_set($this->sparkline, 'sparkline.enabled', $isEnabled);

        return $this;
    }

    public function sparklined()
    {
        return $this->setSparklineEnabled(true);
    }

    protected function initSparkline()
    {
        $this->sparkline = $this->defaultSparkline();
    }

    private function defaultSparkline()
    {
        return [
            'sparkline' => [
                'enabled' => false,
            ],
        ];
    }

    protected function sparklineFromArray($array)
    {
        $this->sparkline = data_get($array, 'sparkline', $this->defaultSparkline());
    }

    protected function sparklineToArray()
    {
        return [
            'sparkline' => $this->sparkline,
        ];
    }
}
