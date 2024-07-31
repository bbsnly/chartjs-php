<?php

namespace Bbsnly\ChartJs\Config;

class Config implements ConfigInterface
{
    protected array $attributes;

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
     * @return $this
     */
    public function &__set($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Dynamically set the value of a property.
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function __call($name, $value)
    {
        return $this->__set($name, reset($value));
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        array_walk_recursive($this->attributes, function (&$item) {
            if (is_object($item)) {
                $item = $item->toArray();
            }
        });

        return $this->attributes;
    }
}
