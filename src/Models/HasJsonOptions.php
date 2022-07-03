<?php


namespace Asantibanez\LivewireCharts\Models;

use Illuminate\Support\Facades\Storage;

trait HasJsonOptions
{
    private $jsonOptions;

    public function stylesFromJson($rawJson)
    {
        $this->jsonOptions = $rawJson;

        return $this;
    }

    public function stylesFromFile($jsonFile)
    {
        $this->jsonOptions = Storage::get($jsonFile);

        return $this;
    }

    protected function initJsonOptions()
    {
        $this->jsonOptions = $this->defaultJsonOptions();
    }

    private function defaultJsonOptions()
    {
        return '{}';
    }

    protected function jsonOptionsFromArray($array)
    {
        $this->jsonOptions = data_get($array, 'jsonOptions', $this->defaultJsonOptions());
    }

    protected function jsonOptionsToArray()
    {
        return [
            'jsonOptions' => $this->jsonOptions,
        ];
    }
}
