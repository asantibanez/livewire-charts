<?php


namespace Asantibanez\LivewireCharts\Models\Traits;


trait HasTitle
{
    private $title;

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    protected function initTitle()
    {
        $this->title = $this->defaultTitle();
    }

    private function defaultTitle()
    {
        return '';
    }

    protected function titleFromArray($array)
    {
        $this->title = data_get($array, 'title', $this->defaultTitle());
    }

    protected function titleToArray()
    {
        return [
            'title' => $this->title,
        ];
    }
}
