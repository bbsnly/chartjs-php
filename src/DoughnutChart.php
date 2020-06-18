<?php

namespace Bbsnly\ChartJs;

class DoughnutChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = 'doughnut';
    }
}
