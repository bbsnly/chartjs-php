<?php

namespace Chart;


use Chart\Config\Config;

class Chart implements ChartInterface
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var Config
     */
    public $options;

    /**
     * @var Config
     */
    public $data;

    /**
     * Chart constructor.
     */
    public function __construct()
    {
        $this->options = new Config();
        $this->data = new Config();
    }

    /**
     * Return an array with all entered options
     *
     * @return array
     */
    public function get()
    {
        return $this->toArray();
    }

    /**
     * Return a JSON with all entered options
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), true);
    }

    /**
     * Return an array with all entered options
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'type'    => $this->type,
            'data'    => $this->data->toArray(),
            'options' => $this->options->toArray()
        ];
    }
}