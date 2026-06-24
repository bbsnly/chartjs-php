<?php

namespace Bbsnly\ChartJs;

interface ChartInterface
{
    /**
     * @return array<string, mixed>
     */
    public function get(): array;

    public function toJson(): string;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
