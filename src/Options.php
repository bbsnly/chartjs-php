<?php

namespace Chart;

class Options
{
    /**
     * @var bool
     */
    protected $responsive;

    /**
     * @var int
     */
    protected $responsiveAnimationDuration;

    /**
     * Generates an array of options
     *
     * @return array
     */
    public function toArray()
    {
        $res = [];

        if (isset($this->responsive)) {
            $res['responsive'] = $this->responsive;
        }

        if (isset($this->responsiveAnimationDuration)) {
            $res['responsiveAnimationDuration'] = $this->responsiveAnimationDuration;
        }

        return $res;
    }

    /**
     * @param mixed $responsive
     */
    public function setResponsive($responsive)
    {
        $this->responsive = $responsive;
    }

    /**
     * @param mixed $responsiveAnimationDuration
     */
    public function setResponsiveAnimationDuration($responsiveAnimationDuration)
    {
        $this->responsiveAnimationDuration = $responsiveAnimationDuration;
    }
}