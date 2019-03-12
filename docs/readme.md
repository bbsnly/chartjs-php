# ChartJS-PHP

<p align="center">
<a href="https://packagist.org/packages/bbsnly/chartjs-php"><img src="https://poser.pugx.org/bbsnly/chartjs-php/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/bbsnly/chartjs-php"><img src="https://poser.pugx.org/bbsnly/chartjs-php/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://travis-ci.org/bbsnly/chartjs-php"><img src="https://travis-ci.org/bbsnly/chartjs-php.svg?branch=master" alt="License"></a>
<a href="https://packagist.org/packages/bbsnly/chartjs-php"><img src="https://poser.pugx.org/bbsnly/chartjs-php/license.svg" alt="License"></a>
</p>


**For non Laravel projects, please use the [1.2](https://github.com/bbsnly/chartjs-php/tree/1.2) branch**

This package helps you to generate [ChartJS](http://www.chartjs.org/ "ChartJS") element directly in PHP.


## Table of Contents
- [Install](#install)
- [Requirements](#requirements)
- [Charts](#charts)
- [Usage](usage.md)
- [Examples](examples.md)
- [Blade](blade.md)
- [Extend](extend.md)
- [Contributing](#contributing)
- [License](#license)


## Install
Require this package with composer.
```shell
composer require bbsnly/chartjs-php
```

Laravel 5.5 (and later) uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php
```php
Bbsnly\ChartJs\ChartServiceProvider::class,
```


## Requirements
* `php >= 7.1`
* `ChartJS >= 2.0`


## Charts
* [Line](http://www.chartjs.org/docs/latest/charts/line.html)
* [Bar](http://www.chartjs.org/docs/latest/charts/bar.html)
* [Radar](http://www.chartjs.org/docs/latest/charts/radar.html)
* [Doughnut](http://www.chartjs.org/docs/latest/charts/doughnut.html)
* [Pie](http://www.chartjs.org/docs/latest/charts/doughnut.html)
* [Polar Area](http://www.chartjs.org/docs/latest/charts/polar.html)
* [Bubble](http://www.chartjs.org/docs/latest/charts/bubble.html)
* [Scatter](http://www.chartjs.org/docs/latest/charts/scatter.html)
* [Mixed](http://www.chartjs.org/docs/latest/charts/mixed.html)

Also it is possible to use the package with [New Charts](http://www.chartjs.org/docs/latest/developers/charts.html)
using the `Chart` class


## Contributing
Thank you for considering contributing to the ChartJS PHP!


## License
The ChartJS PHP is open-sourced software licensed under the
[MIT license](http://opensource.org/licenses/MIT).
