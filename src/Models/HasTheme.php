<?php


namespace Asantibanez\LivewireCharts\Models;


trait HasTheme
{
    private $theme;
    private $mode;
    private $palette;

    /**
     * Initialize 
     */
    public function initTheme()
    {
        $this->theme = $this->defaultTheme();
    }

    /**
     * set default theme
     * 
     * @return array $theme
     */
    private function defaultTheme()
    {
        return [
            'mode' => 'light',
            'palette' => 'palette1'
        ];
    }

    /**
     * set theme mode
     * 
     * @param string $mode
     * 
     * @return $this
     */
    public function setThemeMode(string $mode)
    {
        data_set($this->theme, 'mode', $mode);

        return $this;
    }
    
    /**
     * set theme mode to dark theme
     * 
     * @return $this
     */
    public function darkMode()
    {
        data_set($this->theme, 'mode', 'dark');

        return $this;
    }

    /**
     * set theme mode to light theme
     * 
     * @return $this
     */
    public function lightMode()
    {
        data_set($this->theme, 'mode', 'light');

        return $this;
    }
    
    /**
     * set the dark mode option to on or off
     * 
     * @param bool $status = true
     * 
     * @return $this
     */
    public function setDarkMode(bool $status = true)
    {
        data_set($this->theme, 'mode', $status ? 'dark' : 'light');

        return $this;
    }

    /**
     * set theme pallete
     * 
     * @param string $pallete
     * 
     * @return $this
     */
    public function setThemePalette(string $palette)
    {
        data_set($this->theme, 'palette', $palette);

        return $this;
    }

    /**
     * convert the theme to array
     * 
     * @param string $mode
     * 
     * @return $this
     */
    protected function themeToArray()
    {
        return [
            'theme' => $this->theme,
        ];
    }

    /**
     * set theme from array
     * 
     * @param string $mode
     * 
     * @return $this
     */
    protected function themeFromArray($array)
    {
        $this->theme = data_get($array, 'theme', $this->defaultTheme());
    }
}
