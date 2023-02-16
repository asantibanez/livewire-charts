<?php

namespace Asantibanez\LivewireCharts\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'livewire-charts:install';

    protected $description = 'Installs Livewire Charts';

    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'livewire-charts:public']);
    }
}
