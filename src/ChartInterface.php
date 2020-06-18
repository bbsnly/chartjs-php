<?php

namespace Bbsnly\ChartJs;

interface ChartInterface
{
    public function get(): array;

    public function toJson(): string;

    public function toArray(): array;
}
