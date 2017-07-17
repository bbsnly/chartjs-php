<?php

namespace Tests;

use Chart\BarChart;
use Chart\Config\Data;
use Chart\Config\Dataset;
use Chart\Config\Options;

class BarChartTest extends TestCase
{
    /**
     * @var BarChart
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = new BarChart;
    }

    /** @test */
    public function can_create_it()
    {
        $this->assertInstanceOf('Chart\BarChart', $this->chart);
    }

    /** @test */
    public function it_is_responsive()
    {
        $expected = [
            'type'    => 'bar',
            'data'    => [],
            'options' => [
                'responsive' => true
            ]
        ];

        $options = (new Options)->responsive(true);
        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_is_animated()
    {
        $expected = [
            'type'    => 'bar',
            'data'    => [],
            'options' => [
                'responsive'                  => true,
                'responsiveAnimationDuration' => 10
            ]
        ];

        $options = (new Options)
            ->responsive(true)
            ->responsiveAnimationDuration(10);

        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_has_basic_datasets_json()
    {
        $datasets = [
            (new Dataset)->data([10, 20, 30]),
            (new Dataset)->data([30, 20, 10])
        ];

        $data = (new Data)->datasets($datasets);

        $this->chart->data($data);

        $expected = json_encode([
            'type'    => 'bar',
            'data'    => [
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
            'type'    => 'bar',
            'data'    => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                    ],
                    [
                        'data' => [30, 20, 10]
                    ]
                ],
                'labels'   => ['Red', 'Green', 'Blue']
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
            'type'    => 'bar',
            'data'    => [
                'datasets' => [
                    [
                        'data'            => [10, 20, 30],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ],
                    [
                        'data'            => [30, 20, 10],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ]
                ],
                'labels'   => ['Red', 'Green', 'Blue']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }
}