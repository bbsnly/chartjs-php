# ChartJS-PHP

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](CODE_OF_CONDUCT.md)
[![GitHub Actions Tests](https://github.com/bbsnly/chartjs-php/actions/workflows/php.yml/badge.svg)](https://github.com/bbsnly/chartjs-php/actions)
[![Total Downloads](https://poser.pugx.org/bbsnly/chartjs-php/d/total.svg)](https://packagist.org/packages/bbsnly/chartjs-php)
[![Latest Stable Version](https://poser.pugx.org/bbsnly/chartjs-php/v/stable.svg)](https://packagist.org/packages/bbsnly/chartjs-php)
[![License](https://poser.pugx.org/bbsnly/chartjs-php/license.svg)](https://packagist.org/packages/bbsnly/chartjs-php)

This package helps you to generate [ChartJS](https://www.chartjs.org/ "ChartJS") element directly in PHP.

This package is a powerful tool designed to streamline the process of creating [ChartJS](https://www.chartjs.org/ "ChartJS") elements. [ChartJS](https://www.chartjs.org/ "ChartJS") is a popular JavaScript library used for creating beautiful, responsive, and interactive charts. However, it requires writing JavaScript code, which might not be convenient or efficient in a PHP environment.

ChartJS-PHP bridges this gap by allowing developers to generate [ChartJS](https://www.chartjs.org/ "ChartJS") elements directly in PHP. This means you can create and manipulate [ChartJS](https://www.chartjs.org/ "ChartJS") charts using PHP code, without needing to write any JavaScript. This not only makes your code cleaner and more maintainable, but also enhances productivity by leveraging the power and simplicity of PHP. Whether you're building a data visualization tool, a dashboard, or any application that requires dynamic charts, ChartJS-PHP can be a valuable addition to your PHP toolkit.

**For the ChartJS-PHP package to work correctly, install the ChartJS library following the guidelines on their [official documentation](<https://www.chartjs.org/docs/latest/getting-started/>).**

## Installation

To install ChartJS-PHP, you can use [Composer](https://getcomposer.org/), a dependency management tool for PHP. Make sure you have Composer installed on your system, and then run the following command in your project directory:

```shell
composer require bbsnly/chartjs-php
```

Minimum Requirements:

- PHP version: 8.2 or higher
- ChartJS version: 2.0 or higher

## Usage

To use ChartJS-PHP, you need to create a new instance of the `Chart` class and set the chart type, data, and options. You can then render the chart to generate the HTML and JavaScript code for the chart.

In the example below we will create a simple line chart using the `Chart` class. We will set the chart type to `line`, add labels and data to the chart, and set the chart options.

It is also possible to use `BarChart`, `BubbleChart`, `DoughnutChart`, `LineChart`, `PieChart`, `PolarAreaChart`, `RadarChart`, and `ScatterChart` classes to create the respective chart types.

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

To run the tests, you can use the following command:

```shell
composer test
```

## Contributing

Please check the [Contributing](CONTRIBUTING.md) guidelines.

## License

The ChartJS PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
