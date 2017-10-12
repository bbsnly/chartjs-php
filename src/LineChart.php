<?php

namespace Bbsnly\ChartJs;

class LineChart extends Chart
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
