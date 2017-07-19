<?php

namespace Tests;

use Chart\LineChart;

class LineChartTest extends TestCase
{
    /**
     * @var LineChart
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = new LineChart;
    }

    /** @test */
    public function can_create_it()
    {
        $this->assertInstanceOf('Chart\LineChart', $this->chart);
    }
}