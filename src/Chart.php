<?php

namespace Chart;


use Chart\Config\ConfigInterface;
use Chart\Config\Data;
use Chart\Config\Options;

class Chart implements ChartInterface
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var Options
     */
    public $options;

    /**
     * @var Data
     */
    public $data;

    /**
     * Chart constructor.
     */
    public function __construct()
    {
        $this->options = new Options();
        $this->data = new Data();
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
     * Set the chart options
     *
     * @param ConfigInterface $options
     *
     * @return $this
     */
    public function options(ConfigInterface $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Set the chart data
     *
     * @param ConfigInterface $data
     *
     * @return $this
     */
    public function data(ConfigInterface $data)
    {
        $this->data = $data;

        return $this;
    }
}