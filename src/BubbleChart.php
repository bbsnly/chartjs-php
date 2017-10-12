<?php

namespace Bbsnly\ChartJs;

class BubbleChart extends Chart
{
    /**
     * LineChart constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->type = 'bubble';
    }
}
