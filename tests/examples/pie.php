<?php


use Chart\Config\Data;
use Chart\Config\Dataset;
use Chart\Config\Options;
use Chart\PieChart;

require_once __DIR__ . '/../../vendor/autoload.php';

$chart = new PieChart();
$data = new Data;
$options = new Options();

$datasets = [
    (new Dataset)->data([10, 20, 30])
        ->backgroundColor(['red', 'green', 'blue'])
];

$data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

$chart->data($data);

$options = $options->responsive(false);
$chart->options($options);

$myChart = $chart->toJson();

include_once __DIR__ . '/base.php';
