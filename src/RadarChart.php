<?php

namespace Bbsnly\ChartJs;

class RadarChart extends Chart
{
    /**
     * LineChart constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->type = 'radar';
    }
}
