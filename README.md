# ChartJS-PHP

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](CODE_OF_CONDUCT.md)
[![Tests](https://github.com/bbsnly/chartjs-php/actions/workflows/php.yml/badge.svg)](https://github.com/bbsnly/chartjs-php/actions)
[![Total Downloads](https://poser.pugx.org/bbsnly/chartjs-php/d/total.svg)](https://packagist.org/packages/bbsnly/chartjs-php)
[![Latest Stable Version](https://poser.pugx.org/bbsnly/chartjs-php/v/stable.svg)](https://packagist.org/packages/bbsnly/chartjs-php)
[![License](https://poser.pugx.org/bbsnly/chartjs-php/license.svg)](https://packagist.org/packages/bbsnly/chartjs-php)

This package transforms how you create [ChartJS](https://www.chartjs.org/ "ChartJS") elements by bringing them directly into PHP.

ChartJS-PHP eliminates the complexity of JavaScript when working with [ChartJS](https://www.chartjs.org/ "ChartJS") charts. While [ChartJS](https://www.chartjs.org/ "ChartJS") traditionally requires JavaScript implementation, our PHP solution delivers the same powerful charts through clean, efficient PHP code. By generating [ChartJS](https://www.chartjs.org/ "ChartJS") elements directly in PHP, you write less code, maintain cleaner codebases, and deliver faster results. This is the definitive solution for PHP developers building data visualizations, dashboards, or any application requiring dynamic charts.

**Note: Include the ChartJS library in your project as specified in their [official documentation](<https://www.chartjs.org/docs/latest/getting-started/>).**

## Installation

Installing ChartJS-PHP is straightforward with [Composer](https://getcomposer.org/). Run this command in your project directory:

```shell
composer require bbsnly/chartjs-php
```

Minimum Requirements:

- PHP version: 8.2 or higher
- ChartJS version: 2.0 or higher

## Usage

Creating charts with ChartJS-PHP is simple and intuitive. Start by instantiating the `Chart` class, define your data, and render your chart. The library handles all the complexity for you.

Choose from our specialized chart classes for even faster development: `BarChart`, `BubbleChart`, `DoughnutChart`, `LineChart`, `PieChart`, `PolarAreaChart`, `RadarChart`, and `ScatterChart`.

Here's how to create a line chart:

```php
use Bbsnly\ChartJs\Chart;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Dataset;
use Bbsnly\ChartJs\Config\Options;

$chart = new Chart;
$chart->type = 'line';

$data = new Data();
$data->labels = ['Red', 'Green', 'Blue'];

$dataset = new Dataset();
$dataset->data = [5, 10, 20];
$data->datasets[] = $dataset->data;

$chart->data($data);

$options = new Options();
$options->responsive = true;
$chart->options($options);

$chart->get(); // Returns the array of chart data
$chart->toJson(); // Returns the JSON representation of the chart data
$chart->toHtml('my_chart'); // Returns the HTML and JavaScript code for the chart
```

---

In the example below we will use the `toHtml` method to generate the HTML and JavaScript code for the chart.

```php
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div>
    <?= $chart->toHtml('my_chart'); ?>
</div>
```

---

In the example below we will use the `toJson` method to generate the JSON representation of the chart data.

```php
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, <?= $chart->toJson(); ?>);
</script>
```

## Tests

Run the test suite with:

```shell
composer test
```

## Contributing

Read our [Contributing](CONTRIBUTING.md) guidelines and start improving ChartJS-PHP today.

## License

The ChartJS PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
