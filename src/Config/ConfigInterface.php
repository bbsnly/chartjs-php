<?php

namespace Bbsnly\ChartJs\Config;

interface ConfigInterface
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
