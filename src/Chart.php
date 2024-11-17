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
     * @throws \JsonException
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
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

        $uniqueSuffix = '_' . uniqid();
        $elementId = htmlspecialchars($element . $uniqueSuffix, ENT_QUOTES, 'UTF-8');
        $chartId = 'chart' . $uniqueSuffix;
        $instancesVar = 'bbsnlyChartJSInstances'; // Namespace the global variable

        return '<canvas id="' . $elementId . '"></canvas>
        <script>
            (function() {
                const canvas = document.getElementById("' . $elementId . '");
                if (!canvas) {
                    console.error("Canvas element not found: ' . $elementId . '");
                    return;
                }
                const ctx = canvas.getContext("2d");
                const ' . $chartId . ' = new Chart(ctx, ' . $chart->toJson() . ');

                // Store chart instance for potential external access
                if (typeof window.' . $instancesVar . ' === "undefined") {
                    window.' . $instancesVar . ' = {};
                }
                window.' . $instancesVar . '["' . $elementId . '"] = ' . $chartId . ';

                // Cleanup on page unload to prevent memory leaks
                window.addEventListener("unload", function() {
                    if (window.' . $instancesVar . '["' . $elementId . '"]) {
                        ' . $chartId . '.destroy();
                        delete window.' . $instancesVar . '["' . $elementId . '"];
                    }
                });
            })();
        </script>';
    }
}
