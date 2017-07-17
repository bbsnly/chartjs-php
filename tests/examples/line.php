<?php

use Chart\Config\Data;
use Chart\Config\Dataset;
use Chart\Config\Options;
use Chart\LineChart;

require_once __DIR__ . '/../../vendor/autoload.php';

$chart = new LineChart;
$data = new Data;
$options = new Options;

$datasets = [
    (new Dataset)->data([0, 3000, 3500, 4000])
        ->fill(false)->label('USD')
        ->backgroundColor('rgb(74, 142, 189)')
        ->borderColor('rgb(74, 142, 189)')
];

$data->datasets($datasets)->labels([2014, 2015, 2016, 2017]);

$chart->data($data);

$options->responsive(false);
$chart->options($options);

$myChart = $chart->toJson();

include_once __DIR__ . '/base.php';
