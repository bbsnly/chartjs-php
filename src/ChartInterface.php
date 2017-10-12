<?php

namespace Bbsnly\ChartJs;

interface ChartInterface
{
    public function get();

    public function toJson();

    public function toArray();
}
