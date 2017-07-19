<?php

namespace Tests;

use Chart\PieChart;

class PieChartTest extends TestCase
{
    /**
     * @var PieChart
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = new PieChart;
    }

    /** @test */
    public function can_create_it()
    {
        $this->assertInstanceOf('Chart\PieChart', $this->chart);
    }
}