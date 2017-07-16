<?php

namespace Chart;

class Options
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->attributes['name'];
    }

    /**
     * Generates an array of options
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }
}