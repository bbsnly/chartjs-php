# ChartJS-PHP

<p align="center">
<a href="https://packagist.org/packages/bbsnly/chartjs-php"><img src="https://poser.pugx.org/bbsnly/chartjs-php/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/bbsnly/chartjs-php"><img src="https://poser.pugx.org/bbsnly/chartjs-php/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://travis-ci.org/bbsnly/chartjs-php"><img src="https://travis-ci.org/bbsnly/chartjs-php.svg?branch=master" alt="License"></a>
<a href="https://packagist.org/packages/bbsnly/chartjs-php"><img src="https://poser.pugx.org/bbsnly/chartjs-php/license.svg" alt="License"></a>
</p>

The package helps you to generate [ChartJS](http://www.chartjs.org/ "ChartJS")
element directly in PHP and translate it to JSON.

## Install
`composer require bbsnly/chartjs-php`

## Test
`composer test`

## Requirements
* `php >= 7.0`
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

## How To
### Create
```
$chart = new Chart;
$chart->type = 'line';
$chart->toJson();
```
and
```
$chart = new LineChart;
$chart->toJson();
```
provides the same result.

### Usage
To personalize your chart you have three options:
* Using arrays
* Using attributes
* Using methods

#### Examples
Using arrays
```
$chart->data([
    'labels' => ['Red', 'Green', 'Blue'],
    'datasets' => [{
        'data' => [5, 10, 20]
    }]
]);

$chart->options([
    'responsive' => true
]);
```
Using attributes
```
$data = new Data();

$data->labels = ['Red', 'Green', 'Blue'];

$dataset = new Dataset();
$dataset->data = [5, 10, 20];
$data->datasets[] = $dataset->data;

$chart->data($data);

$options = new Options();
$options->responsive = true;
$chart->options($options);
```
Using methods
```
$data = new Data;

$data->datasets([
    (new Dataset)->data([5, 10, 20])
])->labels(['Red', 'Green', 'Blue']);

$chart->data($data);

$options = new Options();
$options->responsive(true);
$chart->options($options);
```
### Config class
To configure your chart you can use the `Config` class directly or helpers
like `Dataset` or `Options`.

You can extend it and add a helper for wherever you need (ex. `Scales`).

If you decide to override the `Config` class you should implement
the `ConfigInterface` to be sure about the compatibility.

## Code Examples
You can find some examples
[here](https://github.com/bbsnly/chartjs-php/tree/master/tests/examples "ChartJS PHP Examples")

## Contributing

Thank you for considering contributing to the ChartJS PHP!

## License

The ChartJS PHP is open-sourced software licensed under the
[MIT license](http://opensource.org/licenses/MIT).