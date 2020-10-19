# Livewire Charts

Neat Livewire Charts for your Laravel projects.

### Preview

![preview](https://github.com/asantibanez/livewire-charts/raw/master/preview.gif)

## Installation

You can install the package via composer:

```bash
composer require asantibanez/livewire-charts
```

### Requirements

This package requires the following packages/libraries to work:
- `Laravel Livewire v2` (https://laravel-livewire.com/) 
- `Alpine Js` (https://github.com/alpinejs/alpine)
- `Apex Charts` (https://apexcharts.com/)

Please follow each package/library instructions on how to set them properly in your project.

NOTE: At the moment, `Apex Charts` is only supported for drawing charts.  

## Usage

Livewire Charts supports out of the box the following types of charts
- Line Chart (`LivewireLineChart` component)
- Pie Chart (`LivewirePieChart` component)
- Column Chart (`LivewireColumnChart` component)

Each one comes with its own "model" class that allows you to define the chart's data and render behavior. 
- `LivewireLineChart` uses `LineChartModel` to set up data points, markers, events and other ui customizations. 
- `LivewirePieChart` uses `PieChartModel` to set up data slices, events and other ui customizations. 
- `LivewireColumnChart` uses `ColumnChartModel` to set up data columns, events and other ui customizations.

For example, to render a column chart, we can create an instance of `ColumnChartModel` and add some data to it
```php
$columnChartModel = 
    (new ColumnChartModel())
        ->setTitle('Expenses by Type')
        ->addColumn('Food', 100, '#f6ad55')
        ->addColumn('Shopping', 200, '#fc8181')
        ->addColumn('Travel', 300, '#90cdf4')
    ;
``` 

With `$columnChartModel` at hand, we pass it to our `LivewireColumnChart` component in our Blade template.

```blade
<livewire:livewire-column-chart
    :column-chart-model="$columnChartModel"
/>
```

And that's it! You have a beautiful rendered chart in seconds. 👌

![column chart example](https://github.com/asantibanez/livewire-charts/raw/master/column-chart-example.png)

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email santibanez.andres@gmail.com instead of using the issue tracker.

## Credits

- [Andrés Santibáñez](https://github.com/asantibanez)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
