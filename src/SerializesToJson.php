<?php

namespace Bbsnly\ChartJs;

use Bbsnly\ChartJs\Config\ConfigInterface;

/**
 * Shared get()/toJson() implementations for chart and config objects.
 */
trait SerializesToJson
{
    /**
     * Get the object as an array.
     *
     * @return array<string, mixed>
     */
    public function get(): array
    {
        return $this->toArray();
    }

    /**
     * Convert the object to JSON safe for embedding in HTML.
     *
     * @throws \JsonException
     */
    public function toJson(): string
    {
        return json_encode($this, ConfigInterface::JSON_FLAGS);
    }

    /**
     * @return array<string, mixed>
     */
    abstract public function toArray(): array;
}
