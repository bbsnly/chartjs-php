<?php

namespace Chart;


class LineChart extends Chart implements ChartInterface
{
    /**
     * LineChart constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->type = 'line';
    }
}