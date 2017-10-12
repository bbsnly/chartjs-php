<?php

namespace Bbsnly\ChartJs;

use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Options;

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
            'type' => $this->type,
            'data' => $this->data->toArray(),
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
     * @param $options
     *
     * @return $this
     */
    public function options($options)
    {
        if (is_array($options)) {
            $options = new Options($options);
        }

        $this->options = $options;

        return $this;
    }

    /**
     * Set the chart data
     *
     * @param $data
     *
     * @return $this
     */
    public function data($data)
    {
        if (is_array($data)) {
            $data = new Data($data);
        }

        $this->data = $data;

        return $this;
    }

    /**
     * Helper to generate beginAtZero configuration
     */
    public function beginAtZero()
    {
        $this->options->scales([
            'yAxes' => [
                [
                    'ticks' => [
                        'beginAtZero' => true
                    ]
                ]
            ]
        ]);

        return $this;
    }
}
