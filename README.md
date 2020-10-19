# Livewire Charts

Neat Livewire Charts for your Laravel projects.

## Preview

![preview](https://github.com/asantibanez/livewire-charts/raw/master/preview.gif)

## Installation

You can install the package via composer:

```bash
composer require asantibanez/livewire-charts
```

## Requirements

This package requires the following packages/libraries to work:
- `Laravel Livewire v2` (https://laravel-livewire.com/) 
- `Alpine Js` (https://github.com/alpinejs/alpine)
- `Apex Charts` (https://apexcharts.com/)

Please follow each package/library instructions on how to set them properly in your project.

> Note: At the moment, `Apex Charts` is only supported for drawing charts.  

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

> Note: Chart model methods are chainable 💪 

With `$columnChartModel` at hand, we pass it to our `LivewireColumnChart` component in our Blade template. 

```blade
<livewire:livewire-column-chart
    :column-chart-model="$columnChartModel"
/>
``` 

And that's it! You have a beautiful rendered chart in seconds. 👌

![column chart example](https://github.com/asantibanez/livewire-charts/raw/master/column-chart-example.png)

> Note: You can use these charts inside other Livewire components too. Just render them in your Blade template and you
are good to go. 👍

## Enabling Interactions

To enable click events, you must use the `with[XXX]ClickEvent($eventName)` method present in every model class and 
define a custom `$eventName` that will be fired with the corresponding data when a column/marker/slice is clicked.

```php
$columnChartModel = 
    (new ColumnChartModel())
        ->setTitle('Expenses by Type')
        ->withOnColumnClickEventName('onColumnClick')
    ;
``` 
 
 Here we define an `onColumnClick` event that will be fired when a column is clicked in our chart. 
 
 We can listen to the `onClickEvent` registering a listener in any other Livewire component.
 
 ```php
 protected $listeners = [
     'onColumnClick' => 'handleOnColumnClick',
 ];
 ``` 

## Charts "Reactivity"

You can use livewire-charts components as nested components in you Livewire components. Once rendered, charts will
not automatically react to changes in the `$model` passed in. This is just how Livewire works. 

However, to enable "reactivity" when data passed in changes, you can define a special `$key` 
to your components so they are fully re-rendered each time the chart data changes. 

Each model class comes with a `reactiveKey()` method that returns a string based on its data. If any of the properties
are changed, this key will update accordingly and re-render the chart again.

In the following example, a parent component houses both column chart and pie chart and defines a `$model` for each one. 
The parent component renders the charts as follows

```php
<livewire:livewire-column-chart
    key="{{ $columnChartModel->reactiveKey() }}"
    :column-chart-model="$columnChartModel"
/>

<livewire:livewire-pie-chart
    key="{{ $pieChartModel->reactiveKey() }}"
    :pie-chart-model="$pieChartModel"
/>
``` 
 
 When the parent component changes their respective models, charts will automatically re-render itself.
 
 ![reactive charts example](https://github.com/asantibanez/livewire-charts/raw/master/reactive-charts-example.gif)
 
  

## Charts API

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
