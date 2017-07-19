<?php

namespace Tests;

use Chart\BarChart;

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
}