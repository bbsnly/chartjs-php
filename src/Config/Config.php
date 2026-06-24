<?php

namespace Bbsnly\ChartJs\Config;

class Config implements ConfigInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $attributes;

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
     * @param string $name
     * @return mixed
     */
    public function &__get($name)
    {
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
        $this->attributes[$name] = $value;
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
        $this->__set($name, reset($value));

        return $this;
    }

    /**
     * Convert the object to an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        array_walk_recursive($this->attributes, function (&$item) {
            if (is_object($item) && method_exists($item, 'toArray')) {
                $item = $item->toArray();
            }
        });

        return $this->attributes;
    }

    /**
     * @return array<string, mixed>
     */
    public function get(): array
    {
        return $this->toArray();
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
    }
}
