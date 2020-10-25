<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasLegend
{
    private $legend;

    public function initLegend()
    {
        $this->legend = $this->defaultLegend();
    }

    private function defaultLegend()
    {
        return [
            'show' => true,
            'position' => 'bottom',
            'horizontalAlign' => 'center',
        ];
    }

    public function setLegendVisibility($visible)
    {
        data_set($this->legend, 'show', $visible);

        return $this;
    }

    public function setLegendPosition($position)
    {
        data_set($this->legend, 'position', $position);

        return $this;
    }

    public function setLegendHorizontalAlign($horizontalAlign)
    {
        data_set($this->legend, 'horizontalAlign', $horizontalAlign);

        return $this;
    }

    public function withoutLegend()
    {
        return $this->setLegendVisibility(false);
    }

    public function withLegend()
    {
        return $this->setLegendVisibility(true);
    }

    public function legendPositionTop()
    {
        return $this->setLegendPosition('top');
    }

    public function legendPositionLeft()
    {
        return $this->setLegendPosition('left');
    }

    public function legendPositionRight()
    {
        return $this->setLegendPosition('right');
    }

    public function legendPositionBottom()
    {
        return $this->setLegendPosition('bottom');
    }

    public function legendHorizontallyAlignedLeft()
    {
        return $this->setLegendHorizontalAlign('left');
    }

    public function legendHorizontallyAlignedCenter()
    {
        return $this->setLegendHorizontalAlign('center');
    }

    public function legendHorizontallyAlignedRight()
    {
        return $this->setLegendHorizontalAlign('right');
    }

    protected function legendToArray()
    {
        return [
            'legend' => $this->legend,
        ];
    }

    protected function legendFromArray($array)
    {
        $this->legend = data_get($array, 'legend', $this->defaultLegend());
    }
}
