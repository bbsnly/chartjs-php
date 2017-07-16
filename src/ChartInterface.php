<?php

namespace Chart;

interface ChartInterface
{
    public function get();

    public function toJson();

    public function toArray();
}