<?php

namespace Chart;

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