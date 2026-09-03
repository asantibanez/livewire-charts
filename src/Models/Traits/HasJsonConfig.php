<?php


namespace Asantibanez\LivewireCharts\Models\Traits;

use Asantibanez\LivewireCharts\Formatters;
use InvalidArgumentException;

trait HasJsonConfig
{
    private $jsonConfig;

    /**
     * Set additional Apex chart properties using dot-notation keys.
     *
     * Values may be scalars (int, float, bool, string), arrays, or a
     * formatter constant from \Asantibanez\LivewireCharts\Formatters, e.g.
     *   Formatters::CURRENCY  →  'formatter:currency'
     *
     * Raw JavaScript strings (containing "function" or "=>") are rejected
     * with an InvalidArgumentException — use a Formatters constant instead.
     *
     * @param  array $jsonConfig
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function setJsonConfig($jsonConfig)
    {
        foreach ($jsonConfig as $key => $value) {
            if (!is_string($value)) {
                continue;
            }

            // Reject raw JS function bodies that were the previous (insecure) API
            if (strpos($value, 'function') !== false || strpos($value, '=>') !== false) {
                throw new InvalidArgumentException(
                    "livewire-charts: setJsonConfig() no longer accepts raw JavaScript strings. " .
                    "Use a Formatters constant instead, e.g. Formatters::CURRENCY. " .
                    "See \\Asantibanez\\LivewireCharts\\Formatters for all available options."
                );
            }

            // Validate formatter: references against the known registry
            if (strpos($value, 'formatter:') === 0) {
                $name = substr($value, strlen('formatter:'));
                if (!in_array($name, Formatters::known(), true)) {
                    throw new InvalidArgumentException(
                        "livewire-charts: unknown formatter \"" . $name . "\" for key \"" . $key . "\". " .
                        "Available: " . implode(', ', Formatters::known()) . "."
                    );
                }
            }
        }

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
