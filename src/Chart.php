<?php

namespace Bbsnly\ChartJs;

use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Options;

class Chart implements ChartInterface
{
    public ?string $type;

    public Options $options;

    public Data $data;

    public function __construct()
    {
        $this->type = null;

        $this->options = new Options();

        $this->data = new Data();
    }

    /**
     * Get the chart as an array
     *
     * @return array
     */
    public function get(): array
    {
        return $this->toArray();
    }

    /**
     * Convert the chart to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'data' => $this->data->toArray(),
            'options' => $this->options->toArray()
        ];
    }

    /**
     * Convert the chart to JSON
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), true);
    }

    /**
     * Set the chart options
     *
     * @param Options $options
     * @return self
     */
    public function options(Options $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Set the chart data
     *
     * @param Data $data
     * @return self
     */
    public function data(Data $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Helper to generate beginAtZero configuration
     *
     * @return self
     */
    public function beginAtZero(): self
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

    /**
     * Generate the HTML representation of the chart
     *
     * @param string $element
     * @param Chart $chart
     * @return string
     */
    public function toHtml(string $element, Chart $chart = null): string
    {
        if ($chart === null) {
            $chart = $this;
        }

        return '<canvas id="' . $element . '"></canvas>
        <script>
            new Chart(
                document.getElementById("' . $element . '").getContext("2d"),
                ' . $chart->toJson() . '
            );
        </script>';
    }
}
