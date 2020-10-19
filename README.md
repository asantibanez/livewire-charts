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

This package uses `Laravel Livewire v2` (https://laravel-livewire.com/) under the hood. 

It also uses `Alpine Js` (https://github.com/alpinejs/alpine) for creating charts on the 
frontend using `Apex Charts` (https://apexcharts.com/)

NOTE: At the moment, `Apex Charts` is only supported for drawing charts. 

Please make sure you include these dependencies before using this package. 

## Usage

```blade
<livewire:livewire-line-chart
    :line-chart-model="$lineChart"
/>

<livewire:livewire-column-chart
    :column-chart-model="$columnChart"
/>

<livewire:livewire-pie-chart
    :pie-chart-model="$pieChart"
/>
```

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
