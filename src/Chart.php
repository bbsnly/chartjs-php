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

    public function get(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'data' => $this->data->toArray(),
            'options' => $this->options->toArray()
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), true);
    }

    public function options(Options $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function data(Data $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Helper to generate beginAtZero configuration
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
