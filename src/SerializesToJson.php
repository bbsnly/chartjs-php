<?php

namespace Bbsnly\ChartJs;

use Bbsnly\ChartJs\Config\ConfigInterface;
use Bbsnly\ChartJs\Config\JsExpression;

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
     * Convert the object to JSON safe for embedding in HTML. Any
     * JsExpression values are embedded as raw JavaScript, making the
     * output a JS object literal rather than strict JSON.
     *
     * @throws \JsonException
     */
    public function toJson(): string
    {
        $nonce = JsExpression::beginCapture();

        try {
            $json = json_encode($this, ConfigInterface::JSON_FLAGS);
        } finally {
            JsExpression::endCapture();
        }

        return JsExpression::inject($json, $nonce);
    }

    /**
     * @return array<string, mixed>
     */
    abstract public function toArray(): array;
}
