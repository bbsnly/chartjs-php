<?php

namespace Bbsnly\ChartJs;

class PolarAreaChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = 'polarArea';
    }
}
