<?php

namespace Chart;


class Chart implements ChartInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var array
     */
    protected $dataset = [];

    /**
     * Chart constructor.
     */
    public function __construct()
    {
        $this->options = new Options();
        $this->dataset = new Dataset();
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Resizes the chart canvas when its container does
     *
     * @param bool $status
     *
     * @return $this
     */
    public function isResponsive($status = true)
    {
        $this->options->responsive = $status;

        return $this;
    }

    /**
     * Duration in milliseconds it takes to animate
     * to new size after a resize event.
     *
     * @param int $duration
     *
     * @return $this
     */
    public function responsiveAnimationDuration($duration = 0)
    {
        $this->options->responsiveAnimationDuration = $duration;

        return $this;
    }

    /**
     * Return an array with all entered options
     *
     * @return array
     */
    public function get()
    {
        return [
            'type'    => $this->type,
            'dataset' => $this->dataset->toArray(),
            'options' => $this->options->toArray()
        ];
    }
}