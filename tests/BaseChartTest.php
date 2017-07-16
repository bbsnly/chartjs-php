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
            'type'    => '',
            'dataset' => [],
            'options' => [
                'responsive' => true
            ]
        ];

        $this->assertEquals($expected, $this->chart->isResponsive()->get());
    }

    /** @test */
    public function it_is_animated()
    {
        $expected = [
            'type'    => '',
            'dataset' => [],
            'options' => [
                'responsiveAnimationDuration' => 10
            ]
        ];

        $this->assertEquals($expected, $this->chart->responsiveAnimationDuration(10)->get());
    }
}