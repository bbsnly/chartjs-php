<?php

namespace Bbsnly\ChartJs\Config;

use ArgumentCountError;
use Bbsnly\ChartJs\SerializesToJson;

class Config implements ConfigInterface
{
    use SerializesToJson;

    /**
     * @var array<string, mixed>
     */
    protected array $attributes;

    /**
     * Keys created as a side effect of reading a property that was never
     * written to. They are skipped at serialization time while they are
     * still null, so a plain read does not leak `"key": null` into the
     * Chart.js config.
     *
     * @var array<string, true>
     */
    protected array $autoCreated = [];

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Get the value of a property.
     *
     * Returns by reference so appends work on not-yet-existing keys
     * ($data->datasets[] = ...). Reading a missing key therefore has to
     * create it; such keys are tracked and dropped by toArray() while
     * their value remains null.
     *
     * @param string $name
     * @return mixed
     */
    public function &__get($name)
    {
        if (!array_key_exists($name, $this->attributes)) {
            $this->autoCreated[$name] = true;
            $this->attributes[$name] = null;
        }

        return $this->attributes[$name];
    }

    /**
     * Set the value of a property.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        unset($this->autoCreated[$name]);

        $this->attributes[$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @param string $name
     * @return void
     */
    public function __unset($name)
    {
        unset($this->autoCreated[$name], $this->attributes[$name]);
    }

    /**
     * Break the reference slots &__get() may have created, so writes
     * through a reference held on the original cannot reach the clone
     * (or vice versa).
     *
     * @return void
     */
    public function __clone()
    {
        $attributes = [];

        foreach ($this->attributes as $name => $value) {
            $attributes[$name] = $value;
        }

        $this->attributes = $attributes;
    }

    /**
     * Dynamically set the value of a property.
     *
     * @param string $name
     * @param array<int, mixed> $value
     * @return $this
     */
    public function __call($name, $value)
    {
        if (count($value) !== 1) {
            throw new ArgumentCountError(
                sprintf('%s::%s() expects exactly 1 argument, %d given', static::class, $name, count($value))
            );
        }

        $this->__set($name, reset($value));

        return $this;
    }

    /**
     * Convert the object to an array without mutating it — the conversion
     * builds a fresh structure, so it is safe even when callers hold
     * references into the attributes. Nested objects exposing toArray()
     * are converted recursively; keys auto-created by a read that still
     * hold null are dropped.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $attributes = [];

        foreach ($this->attributes as $name => $value) {
            if (isset($this->autoCreated[$name]) && $value === null) {
                continue;
            }

            $attributes[$name] = $this->convertToArray($value);
        }

        return $attributes;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function convertToArray($value)
    {
        if (is_object($value) && method_exists($value, 'toArray')) {
            return $value->toArray();
        }

        if (!is_array($value)) {
            return $value;
        }

        // Scalar-only arrays (the common shape of large datasets) are
        // returned as-is so copy-on-write can share them instead of
        // deep-copying thousands of points.
        $needsConversion = false;
        foreach ($value as $item) {
            if (is_object($item) || is_array($item)) {
                $needsConversion = true;
                break;
            }
        }

        if (!$needsConversion) {
            return $value;
        }

        // Build a fresh array rather than writing into $value: a write
        // could otherwise travel through reference slots inside the copied
        // array and mutate the original attributes.
        $converted = [];

        foreach ($value as $key => $item) {
            $converted[$key] = (is_object($item) || is_array($item)) ? $this->convertToArray($item) : $item;
        }

        return $converted;
    }

    /**
     * An empty config must encode as a JSON object, not a JSON array, to
     * match the config shape Chart.js expects.
     *
     * @return array<string, mixed>|\stdClass
     */
    public function jsonSerialize(): array|\stdClass
    {
        $attributes = $this->toArray();

        return $attributes === [] ? new \stdClass() : $attributes;
    }
}
