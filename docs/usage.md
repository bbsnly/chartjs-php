# Usage

## Table of Contents
- [Using arrays](#using-arrays)
- [Using attributes](#using-attributes)
- [Using methods](#using-methods)

To personalize your chart you have three options:
* Using arrays
* Using attributes
* Using methods

All data and options element are dynamic so you can create tthe exact configuration you need.


#### Using arrays
```php
$chart = app(Bbsnly\ChartJs\Chart::class);

$chart->type = 'bar';

$chart->data([
    'labels' => ['Red', 'Green', 'Blue'],
    'datasets' => [
        [
            'data' => [5, 10, 20]
        ]
    ]
]);

$chart->options([
    'responsive' => true
]);
```
#### Using attributes
```php
$chart = app(Bbsnly\ChartJs\Chart::class);

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
```
#### Using methods
```php
$chart = app(Bbsnly\ChartJs\Chart::class);

$chart->type = 'bar';

$data = new Data;

$data->datasets([
    (new Dataset)->data([5, 10, 20])
])->labels(['Red', 'Green', 'Blue']);

$chart->data($data);

$options = new Options();
$options->responsive(true);
$chart->options($options);
```
