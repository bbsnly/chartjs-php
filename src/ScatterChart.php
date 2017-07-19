<?php

namespace Chart;

class ScatterChart extends Chart
{
    /**
     * LineChart constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->type = 'scatter';
    }
}