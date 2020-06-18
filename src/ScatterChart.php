<?php

namespace Bbsnly\ChartJs;

class ScatterChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = 'scatter';
    }
}
