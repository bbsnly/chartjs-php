<?php

namespace Bbsnly\ChartJs;

class BarChart extends Chart
{
    /**
     * BarChart constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->type = 'bar';
    }
}
