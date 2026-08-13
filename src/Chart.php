<?php

namespace Bbsnly\ChartJs;

use Bbsnly\ChartJs\Config\ConfigInterface;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Options;
use InvalidArgumentException;

class Chart implements ChartInterface
{
    use SerializesToJson;

    public ?string $type = null;

    public Options $options;

    public Data $data;

    public function __construct()
    {
        $this->options = new Options();

        $this->data = new Data();
    }

    public function __clone()
    {
        $this->options = clone $this->options;
        $this->data = clone $this->data;
    }

    /**
     * Convert the chart to an array. A type that was never set is omitted.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $config = [
            'data' => $this->data->toArray(),
            'options' => $this->options->toArray(),
        ];

        if ($this->type !== null) {
            $config = ['type' => $this->type] + $config;
        }

        return $config;
    }

    /**
     * Like toArray(), but keeps data/options as objects so empty configs
     * encode as {} instead of [].
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $config = [
            'data' => $this->data,
            'options' => $this->options,
        ];

        if ($this->type !== null) {
            $config = ['type' => $this->type] + $config;
        }

        return $config;
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
     * Helper to make the y axis begin at zero (Chart.js 3+ scale syntax).
     * Merges into any scales already configured.
     *
     * @return self
     */
    public function beginAtZero(): self
    {
        $scales = $this->options->scales ?? [];

        $yScale = (array) ($scales['y'] ?? []);
        $yScale['beginAtZero'] = true;
        $scales['y'] = $yScale;

        $this->options->scales = $scales;

        return $this;
    }

    /**
     * Generate the HTML and JavaScript for rendering the chart.
     *
     * The canvas id gets a random suffix by default so the same element
     * name can be rendered more than once per page; pass $uniqueId = false
     * to use $element as the id verbatim. Each instance is registered in
     * window.bbsnlyChartJSInstances, keyed by canvas id.
     *
     * @param string $element
     * @param bool $uniqueId
     * @return string
     * @throws InvalidArgumentException when $element is not a valid id
     * @throws \JsonException when the chart config cannot be encoded
     * @throws \Exception when no source of randomness is available
     */
    public function toHtml(string $element, bool $uniqueId = true): string
    {
        if (preg_match('/^[A-Za-z][A-Za-z0-9_-]*$/D', $element) !== 1) {
            throw new InvalidArgumentException(sprintf(
                'Invalid element id "%s": expected a letter followed by letters, digits, hyphens or underscores',
                $element
            ));
        }

        $elementId = $uniqueId ? $element . '_' . bin2hex(random_bytes(6)) : $element;
        $elementIdJs = json_encode($elementId, ConfigInterface::JSON_FLAGS);

        return '<canvas id="' . $elementId . '"></canvas>
        <script>
            (function() {
                const canvas = document.getElementById(' . $elementIdJs . ');
                if (!canvas) {
                    console.error("ChartJS-PHP: canvas element not found:", ' . $elementIdJs . ');
                    return;
                }

                window.bbsnlyChartJSInstances = window.bbsnlyChartJSInstances || {};

                // Re-rendering into the same id (e.g. after a partial page
                // swap) must release the previous chart first, or Chart.js
                // refuses to reuse the canvas.
                if (window.bbsnlyChartJSInstances[' . $elementIdJs . ']) {
                    window.bbsnlyChartJSInstances[' . $elementIdJs . '].destroy();
                }

                const chart = new Chart(canvas, ' . $this->toJson() . ');

                // Expose the instance for external access
                window.bbsnlyChartJSInstances[' . $elementIdJs . '] = chart;

                // Destroy the chart on real navigation away, but keep it
                // alive when the page is suspended into the bfcache.
                window.addEventListener("pagehide", function (event) {
                    if (!event.persisted && window.bbsnlyChartJSInstances[' . $elementIdJs . ']) {
                        window.bbsnlyChartJSInstances[' . $elementIdJs . '].destroy();
                        delete window.bbsnlyChartJSInstances[' . $elementIdJs . '];
                    }
                });
            })();
        </script>';
    }
}
