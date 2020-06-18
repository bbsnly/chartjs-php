<?php

namespace Bbsnly\ChartJs;

class BarChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = 'bar';
    }
}
