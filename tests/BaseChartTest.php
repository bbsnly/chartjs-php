<?php

namespace Tests;

use Chart\Chart;

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
        $this->assertInstanceOf('Chart\Chart', $this->chart);
    }

    /** @test */
    public function it_is_responsive()
    {
        $expected = [
            'type'    => null,
            'data'    => [],
            'options' => [
                'responsive' => true
            ]
        ];

        $this->chart->options->responsive(true);

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_is_animated()
    {
        $expected = [
            'type'    => '',
            'data'    => [],
            'options' => [
                'responsiveAnimationDuration' => 10
            ]
        ];
        $this->chart->options->responsiveAnimationDuration(10);

        $this->assertEquals($expected, $this->chart->get());
    }

    /** @test */
    public function it_has_basic_datasets_array()
    {
        $this->chart->data->datasets([
            [
                'data' => [10, 20, 30]
            ],
            [
                'data' => [30, 20, 10]
            ]
        ]);

        $expected = json_encode([
            'type'    => null,
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
}