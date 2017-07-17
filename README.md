# ChartJS-PHP
The package lets you generate [ChartJS](http://www.chartjs.org/ "ChartJS") element directly in PHP.

## Requirements
* `php >= 5.6`
* `ChartJS >= 2.0`

### Examples
You can find some examples [here](https://github.com/bbsnly/chartjs-php/tree/master/tests/examples "ChartJS PHP Examples")

### Usage
#### Create
To create a new Chart you can use different objects:
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

#### Options
You can personalize your chart using `Config` class or all the helpers classes like `Options` or `Data`.
It's very simple because those classes are totally dynamic so you can add as more options as you need.
```
$data = new Data;
$options = new Options;

$datasets = [
    (new Dataset)->data([0, 3000, 3500, 4000])
        ->fill(false)
        ->label('USD')
        ->backgroundColor('rgb(74, 142, 189)')
        ->borderColor('rgb(74, 142, 189)')
];

$data->datasets($datasets)
     ->labels([2014, 2015, 2016, 2017]);

$options->responsive(false);

$chart->data($data);
$chart->options($options);

$chart->toJson();
```
You can extend `Config` to create your own helpers

## Contributing

Thank you for considering contributing to the ChartJS PHP!

## License

The ChartJS PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).