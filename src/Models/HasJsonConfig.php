<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasJsonConfig
{
    private $jsonConfig;

    public function setJsonConfig($jsonConfig)
    {
        $this->jsonConfig = $jsonConfig;

        return $this;
    }

    protected function initJsonConfig()
    {
        $this->jsonConfig = [];
    }

    private function defaultJsonConfig()
    {
        return [];
    }

    protected function jsonConfigFromArray($array)
    {
        $this->jsonConfig = data_get($array, 'jsonConfig', $this->defaultJsonConfig());
    }

    protected function jsonConfigToArray()
    {
        return [
            'jsonConfig' => $this->jsonConfig,
        ];
    }
}
