<div
    style="width: 100%; height: 100%;"
    x-data="{ ...livewireChartsAreaChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>
</div>

