<?php

namespace Tests;

use Bbsnly\ChartJs\Chart;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Dataset;
use Bbsnly\ChartJs\Config\Options;

class BaseChartTest extends TestCase
{
    /**
     * @var Chart
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = new Chart;
    }

    /** @test */
    public function can_create_it()
    {
        $this->assertInstanceOf('Bbsnly\ChartJs\Chart', $this->chart);
    }

    /** @test */
    public function it_is_responsive()
    {
        $expected = [
            'type' => 'line',
            'data' => [],
            'options' => [
                'responsive' => true
            ]
        ];

        $this->chart->type = 'line';

        $options = (new Options)->responsive(true);
        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_is_animated()
    {
        $expected = [
            'type' => 'line',
            'data' => [],
            'options' => [
                'responsive' => true,
                'responsiveAnimationDuration' => 10
            ]
        ];

        $this->chart->type = 'line';

        $options = (new Options)
            ->responsive(true)
            ->responsiveAnimationDuration(10);

        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_has_basic_datasets_json()
    {
        $data = [
            'datasets' => [
                [
                    'data' => [10, 20, 30]
                ],
                [
                    'data' => [30, 20, 10]
                ]
            ]
        ];

        $this->chart->data($data);

        $expected = json_encode([
            'type' => null,
            'data' => [
                'datasets' => [
                    (object)[
                        'data' => [10, 20, 30]
                    ],
                    (object)[
                        'data' => [30, 20, 10]
                    ]
                ]
            ],
            'options' => []
        ], true);

        $this->assertEquals($expected, $this->chart->toJson());
    }

    /** @test */
    public function it_has_basic_data_with_labels()
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30]),
            (new Dataset)->data([30, 20, 10])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $expected = [
            'type' => null,
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                    ],
                    [
                        'data' => [30, 20, 10]
                    ]
                ],
                'labels' => ['Red', 'Green', 'Blue']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_has_basic_data_with_labels_and_colors()
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30])->backgroundColor(['red', 'green', 'blue']),
            (new Dataset)->data([30, 20, 10])->backgroundColor(['red', 'green', 'blue'])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $expected = [
            'type' => null,
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ],
                    [
                        'data' => [30, 20, 10],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ]
                ],
                'labels' => ['Red', 'Green', 'Blue']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function can_set_start_from_zero_using_helper()
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30])->backgroundColor(['red', 'green', 'blue'])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $this->chart->beginAtZero();

        $expected = [
            'type' => null,
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ]
                ],
                'labels' => ['Red', 'Green', 'Blue']
            ],
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function can_create_mixed_chart_types()
    {
        $this->chart->type = 'bar';

        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30, 40])->label('Bar Dataset'),
            (new Dataset)->data([50, 50, 50, 50])->label('Line Dataset')->type('line'),
        ];

        $data->datasets($datasets)->labels(['January', 'February', 'March', 'April']);

        $this->chart->data($data);

        $expected = [
            'type' => 'bar',
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30, 40],
                        'label' => 'Bar Dataset'
                    ],
                    [
                        'data' => [50, 50, 50, 50],
                        'label' => 'Line Dataset',
                        'type' => 'line'
                    ]
                ],
                'labels' => ['January', 'February', 'March', 'April']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }
}
