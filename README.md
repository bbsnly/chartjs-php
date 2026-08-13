# ChartJS-PHP

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](CODE_OF_CONDUCT.md)
[![Tests](https://github.com/bbsnly/chartjs-php/actions/workflows/php.yml/badge.svg)](https://github.com/bbsnly/chartjs-php/actions)
[![codecov](https://codecov.io/gh/bbsnly/chartjs-php/graph/badge.svg?token=MTIBNP8BDT)](https://codecov.io/gh/bbsnly/chartjs-php)
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

- PHP version: 8.1 or higher (tested up to PHP 8.5)
- ChartJS version: 3.0 or higher (4.x recommended)

Upgrading from v4? See the [upgrade guide](UPGRADE.md).

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
$data->datasets[] = $dataset;

$chart->data($data);

$options = new Options();
$options->responsive = true;
$chart->options($options);

$chart->get(); // Chart config as a PHP array
$chart->toJson(); // Chart config as JSON — use this when feeding Chart.js
$chart->toHtml('my_chart'); // HTML and JavaScript that render the chart
```

When passing the config to Chart.js yourself, always use `toJson()` (or `json_encode($chart)`): it encodes empty `data`/`options` as `{}` the way Chart.js expects. A plain `json_encode($chart->get())` would encode them as `[]`.

The `beginAtZero()` helper makes the y axis start at zero (Chart.js 3+ scale syntax) and merges with any scales you already configured:

```php
$chart->beginAtZero(); // options.scales.y.beginAtZero = true
```

---

In the example below we will use the `toHtml` method to generate the HTML and JavaScript code for the chart.

```html
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div>
    <?= $chart->toHtml('my_chart'); ?>
</div>
```

A few things to know about `toHtml`:

- The element name must start with a letter and may only contain letters, digits, hyphens, and underscores; anything else throws an `InvalidArgumentException`.
- By default the canvas id gets a random suffix (e.g. `my_chart_a1b2c3d4e5f6`) so the same name can be rendered more than once per page. Pass `false` as the second argument — `$chart->toHtml('my_chart', false)` — to use the name verbatim, e.g. when your own CSS or JavaScript needs to target it.
- Every rendered chart instance is registered in `window.bbsnlyChartJSInstances`, keyed by canvas id, so you can access it from your own JavaScript.
- Rendering again into the same verbatim id (e.g. after a partial page swap with Turbo or htmx) destroys the previous chart instance before creating the new one.

---

In the example below we will use the `toJson` method to generate the JSON representation of the chart data.

```html
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, <?= $chart->toJson(); ?>);
</script>
```

### JavaScript callbacks

JSON cannot carry functions, so Chart.js callbacks (tooltip formatters, tick callbacks, scriptable options) would normally arrive as dead strings. Wrap them in `JsExpression` and `toJson()`/`toHtml()` embed them as real JavaScript:

```php
use Bbsnly\ChartJs\Config\JsExpression;

$options = new Options();
$options->plugins = [
    'tooltip' => [
        'callbacks' => [
            'label' => new JsExpression('function (context) { return " $" + context.parsed.y; }'),
        ],
    ],
];
```

**Security:** the wrapped code is emitted into the page unescaped — only wrap code you wrote yourself, never user input. Output containing a `JsExpression` is a JavaScript object literal rather than strict JSON: it works inline, but cannot be `JSON.parse`'d, and a plain `json_encode()` of the config (outside `toJson()`) degrades the expression to an ordinary string. One embedding caveat: because the expression bypasses JSON escaping, avoid the literal sequence `</script>` anywhere inside it (even in its string literals) when rendering via `toHtml()` — the HTML parser would end the inline script block there.

## Tests

Run the test suite and static analysis with:

```shell
composer test
composer analyse
```

## Contributing

Read our [Contributing](CONTRIBUTING.md) guidelines and start improving ChartJS-PHP today.

## License

The ChartJS PHP is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
