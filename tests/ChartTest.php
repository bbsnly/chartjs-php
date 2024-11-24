<?php

namespace Tests;

use Bbsnly\ChartJs\BarChart;
use Bbsnly\ChartJs\BubbleChart;
use Bbsnly\ChartJs\Chart;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Dataset;
use Bbsnly\ChartJs\Config\Options;
use Bbsnly\ChartJs\DoughnutChart;
use Bbsnly\ChartJs\LineChart;
use Bbsnly\ChartJs\PieChart;
use Bbsnly\ChartJs\PolarAreaChart;
use Bbsnly\ChartJs\RadarChart;
use Bbsnly\ChartJs\ScatterChart;

class ChartTest extends TestCase
{
    protected Chart $chart;

    protected function setUp(): void
    {
        $this->chart = new Chart;
    }

    /**
     * Test if the chart instance can be created successfully.
     *
     * We assert that the created instance is an instance of the Chart class.
     */
    public function test_can_create_it()
    {
        $this->assertInstanceOf(Chart::class, $this->chart);
    }

    /**
     * Test if chart type is correctly set using helper class BarChart.
     */
    public function test_can_create_bar_chart()
    {
        $this->chart = new BarChart;
        $this->assertEquals('bar', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class BubbleChart.
     */
    public function test_can_create_bubble_chart()
    {
        $this->chart = new BubbleChart;
        $this->assertEquals('bubble', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class DoughnutChart.
     */
    public function test_can_create_doughnut_chart()
    {
        $this->chart = new DoughnutChart;
        $this->assertEquals('doughnut', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class LineChart.
     */
    public function test_can_create_line_chart()
    {
        $this->chart = new LineChart;
        $this->assertEquals('line', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class PieChart.
     */
    public function test_can_create_pie_chart()
    {
        $this->chart = new PieChart;
        $this->assertEquals('pie', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class PolarAreaChart.
     */
    public function test_can_create_polar_area_chart()
    {
        $this->chart = new PolarAreaChart;
        $this->assertEquals('polarArea', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class RadarChart.
     */
    public function test_can_create_radar_chart()
    {
        $this->chart = new RadarChart;
        $this->assertEquals('radar', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class ScatterChart.
     */
    public function test_can_create_scatter_chart()
    {
        $this->chart = new ScatterChart;
        $this->assertEquals('scatter', $this->chart->type);
    }

    /**
     * Test if the chart is responsive.
     *
     * We set the chart type to 'line' and assert that the chart options
     * include the 'responsive' property set to true.
     */
    public function test_it_is_responsive()
    {
        $expected = [
            'type' => 'line',
            'data' => [],
            'options' => [
                'responsive' => true
            ]
        ];

        $this->chart->type = 'line';

        $options = (new Options)->responsive(true);
        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart is animated.
     *
     * We set the chart type to 'line' and assert that the chart
     * options include the 'responsive' property set to true and the
     * 'responsiveAnimationDuration' property set to 10.
     */
    public function test_it_is_animated()
    {
        $expected = [
            'type' => 'line',
            'data' => [],
            'options' => [
                'responsive' => true,
                'responsiveAnimationDuration' => 10
            ]
        ];

        $this->chart->type = 'line';

        $options = (new Options)
            ->responsive(true)
            ->responsiveAnimationDuration(10);

        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart has basic datasets in JSON format.
     *
     * We create a Data object with two datasets, each containing an array of data values.
     * We set the chart data to the created Data object and assert that the
     * chart data is encoded to the expected JSON format.
     */
    public function test_it_has_basic_datasets_json()
    {
        $data = new Data([
            'datasets' => [
                [
                    'data' => [10, 20, 30]
                ],
                [
                    'data' => [30, 20, 10]
                ]
            ]
        ]);

        $this->chart->data($data);

        $expected = json_encode([
            'type' => null,
            'data' => [
                'datasets' => [
                    (object)[
                        'data' => [10, 20, 30]
                    ],
                    (object)[
                        'data' => [30, 20, 10]
                    ]
                ]
            ],
            'options' => []
        ], true);

        $this->assertEquals($expected, $this->chart->toJson());
    }

    /**
     * Test if the chart has basic data with labels.
     *
     * We create a Data object and two Dataset objects.
     * We set the data values and labels for the datasets and set the chart
     * data to the created Data object.
     * We assert that the chart data includes the datasets, labels, and
     * other properties in the expected format.
     */
    public function test_it_has_basic_data_with_labels()
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30]),
            (new Dataset)->data([30, 20, 10])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $expected = [
            'type' => null,
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                    ],
                    [
                        'data' => [30, 20, 10]
                    ]
                ],
                'labels' => ['Red', 'Green', 'Blue']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart has basic data with labels and colors.
     *
     * We create a Data object and two Dataset objects.
     * We set the data values, labels, and background colors for the datasets
     * and set the chart data to the created Data object.
     * We assert that the chart data includes the datasets, labels,
     * background colors, and other properties in the expected format.
     */
    public function test_it_has_basic_data_with_labels_and_colors()
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30])->backgroundColor(['red', 'green', 'blue']),
            (new Dataset)->data([30, 20, 10])->backgroundColor(['red', 'green', 'blue'])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $expected = [
            'type' => null,
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ],
                    [
                        'data' => [30, 20, 10],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ]
                ],
                'labels' => ['Red', 'Green', 'Blue']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart can be configured to start from zero using a helper method.
     *
     * We create a Data object and a Dataset object.
     * We set the data values and background colors for the dataset and set
     * the chart data to the created Data object.
     * We call the 'beginAtZero' method on the chart instance to configure
     * the y-axis ticks to start from zero.
     * We assert that the chart data includes the datasets, labels,
     * background colors, and other properties in the expected format,
     * including the 'beginAtZero' configuration for the y-axis ticks.
     */
    public function test_can_set_start_from_zero_using_helper()
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30])->backgroundColor(['red', 'green', 'blue'])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $this->chart->beginAtZero();

        $expected = [
            'type' => null,
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30],
                        'backgroundColor' => ['red', 'green', 'blue']
                    ]
                ],
                'labels' => ['Red', 'Green', 'Blue']
            ],
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart can create mixed chart types.
     *
     * We set the chart type to 'bar' and create a Data object.
     * We create two Dataset objects, one for the bar chart and one for the line chart.
     * We set the data values, labels, and chart type for each dataset and set
     * the chart data to the created Data object.
     * We assert that the chart data includes the datasets, labels, chart type,
     * and other properties in the expected format.
     */
    public function test_can_create_mixed_chart_types()
    {
        $this->chart->type = 'bar';

        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30, 40])->label('Bar Dataset'),
            (new Dataset)->data([50, 50, 50, 50])->label('Line Dataset')->type('line'),
        ];

        $data->datasets($datasets)->labels(['January', 'February', 'March', 'April']);

        $this->chart->data($data);

        $expected = [
            'type' => 'bar',
            'data' => [
                'datasets' => [
                    [
                        'data' => [10, 20, 30, 40],
                        'label' => 'Bar Dataset'
                    ],
                    [
                        'data' => [50, 50, 50, 50],
                        'label' => 'Line Dataset',
                        'type' => 'line'
                    ]
                ],
                'labels' => ['January', 'February', 'March', 'April']
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart dataset can be set as an array without using a method.
     */
    public function test_can_set_dataset_as_an_array()
    {
        $this->chart->type = 'bar';

        $data = new Data;
        $dataset = new Dataset();
        $dataset->data = [5, 10, 20];
        $data->datasets[] = $dataset->data;

        $this->chart->data($data);

        $expected = [
            'type' => 'bar',
            'data' => [
                'datasets' => [
                    [5, 10, 20],
                ],
            ],
            'options' => []
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if invalid JSON throws JsonException
     */
    public function test_invalid_json_throws_exception()
    {
        $this->expectException(\JsonException::class);

        // Create an invalid UTF-8 sequence to force JSON encoding error
        $data = new Data();
        $dataset = new Dataset();
        $dataset->data = ["\xFF"]; // Invalid UTF-8 sequence
        $data->datasets([$dataset]);

        $this->chart->data($data);
        $this->chart->toJson();
    }

    /**
     * Test if HTML special characters are properly escaped
     */
    public function test_html_special_chars_are_escaped()
    {
        $maliciousId = '"><script>alert("xss")</script>';
        $html = $this->chart->toHtml($maliciousId);

        // Update assertion to include unique suffix
        $this->assertStringContains('id="&quot;&gt;&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;_', $html);
        $this->assertStringNotContains($maliciousId, $html);
    }

    /**
     * Test if chart cleanup code is present
     */
    public function test_chart_cleanup_code_is_present()
    {
        $html = $this->chart->toHtml('test-chart');
        $chartId = 'chart_' . substr($html, strpos($html, 'chart_') + 6, 13); // Extract the dynamic chart ID

        $this->assertStringContains('window.addEventListener("unload"', $html);
        $this->assertStringContains($chartId . '.destroy()', $html);
    }

    /**
     * Test if JSON output properly escapes HTML characters
     */
    public function test_json_escapes_html_characters()
    {
        $data = new Data;
        $datasets = [
            (new Dataset)->data([1])->label('<script>alert("xss")</script>')
        ];
        $data->datasets($datasets);
        $this->chart->data($data);

        $json = $this->chart->toJson();

        $this->assertStringNotContains('<script>', $json);
        $this->assertStringContains('\u003Cscript\u003E', $json);
    }

    /**
     * Test if chart instances are properly tracked and cleaned up
     */
    public function test_chart_instances_are_tracked()
    {
        $html = $this->chart->toHtml('test-chart');

        // Update assertions to use correct global variable name
        $this->assertStringContains('window.bbsnlyChartJSInstances', $html);
        $this->assertStringContains('bbsnlyChartJSInstances["test-chart_', $html);
        $this->assertStringContains('delete window.bbsnlyChartJSInstances', $html);
    }

    public function test_element_ids_are_unique()
    {
        $html1 = $this->chart->toHtml('my-chart');
        $html2 = $this->chart->toHtml('my-chart');

        preg_match('/id="(my-chart_[^"]+)"/', $html1, $matches1);
        preg_match('/id="(my-chart_[^"]+)"/', $html2, $matches2);

        $this->assertNotEquals($matches1[1], $matches2[1]);
    }

    /**
     * Test if error handling for missing canvas is present
     */
    public function test_canvas_error_handling()
    {
        $html = $this->chart->toHtml('test-chart');

        $this->assertStringContains('if (!canvas)', $html);
        $this->assertStringContains('console.error', $html);
    }

    /**
     * Helper method to assert string contains substring
     */
    private function assertStringContains(string $needle, string $haystack): void
    {
        $this->assertTrue(
            str_contains($haystack, $needle),
            "Failed asserting that '$haystack' contains '$needle'"
        );
    }

    /**
     * Helper method to assert string does not contain substring
     */
    private function assertStringNotContains(string $needle, string $haystack): void
    {
        $this->assertFalse(
            str_contains($haystack, $needle),
            "Failed asserting that '$haystack' does not contain '$needle'"
        );
    }
}
