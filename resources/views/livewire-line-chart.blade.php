<div
    style="width: 100%; height: 100%;"
    x-data="{ ...livewireChartsLineChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>
</div>

