# Usage

## Table of Contents

- [Using attributes](#using-attributes)
- [Using methods](#using-methods)

All data and options element are dynamic so you can create tthe exact configuration you need.

## Using attributes

```php
$chart = new \Bbsnly\ChartJs\Chart;

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

## Using methods

```php
$chart = new \Bbsnly\ChartJs\Chart;

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
