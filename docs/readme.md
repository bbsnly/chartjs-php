# ChartJS-PHP

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](code_of_conduct.md)
[![Total Downloads](https://poser.pugx.org/bbsnly/chartjs-php/d/total.svg)](https://packagist.org/packages/bbsnly/chartjs-php)
[![Latest Stable Version](https://poser.pugx.org/bbsnly/chartjs-php/v/stable.svg)](https://packagist.org/packages/bbsnly/chartjs-php)
[![License](https://poser.pugx.org/bbsnly/chartjs-php/license.svg)](https://packagist.org/packages/bbsnly/chartjs-php)

This package helps you to generate  element directly in PHP.

This package is a powerful tool designed to streamline the process of creating [ChartJS](https://www.chartjs.org/ "ChartJS") elements. [ChartJS](https://www.chartjs.org/ "ChartJS") is a popular JavaScript library used for creating beautiful, responsive, and interactive charts. However, it requires writing JavaScript code, which might not be convenient or efficient in a PHP environment.

ChartJS-PHP bridges this gap by allowing developers to generate [ChartJS](https://www.chartjs.org/ "ChartJS") elements directly in PHP. This means you can create and manipulate [ChartJS](https://www.chartjs.org/ "ChartJS") charts using PHP code, without needing to write any JavaScript. This not only makes your code cleaner and more maintainable, but also enhances productivity by leveraging the power and simplicity of PHP. Whether you're building a data visualization tool, a dashboard, or any application that requires dynamic charts, ChartJS-PHP can be a valuable addition to your PHP toolkit.

## Installation

To install ChartJS-PHP, you can use [Composer](https://getcomposer.org/), a dependency management tool for PHP. Make sure you have Composer installed on your system, and then run the following command in your project directory:

```shell
composer require bbsnly/chartjs-php
```

Minimum Requirements:

- PHP version: 7.4 or higher
- ChartJS version: 2.0 or higher

## Usage

To use ChartJS-PHP, you need to create a new instance of the `Chart` class and set the chart type, data, and options. You can then render the chart to generate the HTML and JavaScript code for the chart.

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

## Tests

To run the tests, you can use the following command:

```shell
composer test
```

## Contributing

Thank you for considering contributing to the ChartJS PHP project! We welcome contributions from the community to help improve and enhance the project. To contribute, please follow these guidelines:

1. Fork the repository and create a new branch for your contribution.
2. Make your changes and ensure they adhere to the project's coding standards.
3. Write tests to cover your changes and ensure they pass.
4. Submit a pull request with a clear description of your changes and the problem they solve.
5. Participate in the review process and address any feedback or comments.

By contributing to ChartJS PHP, you agree to abide by the [Code of Conduct](CODE_OF_CONDUCT.md) of the project.

We appreciate your contributions and look forward to working with you to make ChartJS PHP even better!

## License

The ChartJS PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
