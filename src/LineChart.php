<?php

namespace Bbsnly\ChartJs;

class LineChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = 'line';
    }
}
