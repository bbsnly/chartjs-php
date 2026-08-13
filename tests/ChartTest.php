<?php

namespace Tests;

use ArgumentCountError;
use Bbsnly\ChartJs\BarChart;
use Bbsnly\ChartJs\BubbleChart;
use Bbsnly\ChartJs\Chart;
use Bbsnly\ChartJs\Config\Config;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Dataset;
use Bbsnly\ChartJs\Config\Options;
use Bbsnly\ChartJs\DoughnutChart;
use Bbsnly\ChartJs\LineChart;
use Bbsnly\ChartJs\PieChart;
use Bbsnly\ChartJs\PolarAreaChart;
use Bbsnly\ChartJs\RadarChart;
use Bbsnly\ChartJs\ScatterChart;
use InvalidArgumentException;
use JsonException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ChartTest extends TestCase
{
    protected Chart $chart;

    protected function setUp(): void
    {
        $this->chart = new Chart;
    }

    /**
     * Test if the chart instance can be created successfully.
     */
    public function test_can_create_it(): void
    {
        $this->assertInstanceOf(Chart::class, $this->chart);
    }

    /**
     * Test if chart type is correctly set using helper class BarChart.
     */
    public function test_can_create_bar_chart(): void
    {
        $this->chart = new BarChart;
        $this->assertEquals('bar', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class BubbleChart.
     */
    public function test_can_create_bubble_chart(): void
    {
        $this->chart = new BubbleChart;
        $this->assertEquals('bubble', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class DoughnutChart.
     */
    public function test_can_create_doughnut_chart(): void
    {
        $this->chart = new DoughnutChart;
        $this->assertEquals('doughnut', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class LineChart.
     */
    public function test_can_create_line_chart(): void
    {
        $this->chart = new LineChart;
        $this->assertEquals('line', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class PieChart.
     */
    public function test_can_create_pie_chart(): void
    {
        $this->chart = new PieChart;
        $this->assertEquals('pie', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class PolarAreaChart.
     */
    public function test_can_create_polar_area_chart(): void
    {
        $this->chart = new PolarAreaChart;
        $this->assertEquals('polarArea', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class RadarChart.
     */
    public function test_can_create_radar_chart(): void
    {
        $this->chart = new RadarChart;
        $this->assertEquals('radar', $this->chart->type);
    }

    /**
     * Test if chart type is correctly set using helper class ScatterChart.
     */
    public function test_can_create_scatter_chart(): void
    {
        $this->chart = new ScatterChart;
        $this->assertEquals('scatter', $this->chart->type);
    }

    /**
     * Test if the chart is responsive.
     */
    public function test_it_is_responsive(): void
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
     * Test if the chart is animated using Chart.js 3+ animation options.
     */
    public function test_it_is_animated(): void
    {
        $expected = [
            'type' => 'line',
            'data' => [],
            'options' => [
                'responsive' => true,
                'animation' => [
                    'duration' => 10
                ]
            ]
        ];

        $this->chart->type = 'line';

        $options = (new Options)
            ->responsive(true)
            ->animation(['duration' => 10]);

        $this->chart->options($options);

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if the chart has basic datasets in JSON format.
     */
    public function test_it_has_basic_datasets_json(): void
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

        $expected = [
            'data' => [
                'datasets' => [
                    ['data' => [10, 20, 30]],
                    ['data' => [30, 20, 10]],
                ],
            ],
            'options' => [],
        ];

        $this->assertSame($expected, json_decode($this->chart->toJson(), true));
    }

    /**
     * Test if the chart has basic data with labels.
     */
    public function test_it_has_basic_data_with_labels(): void
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30]),
            (new Dataset)->data([30, 20, 10])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $expected = [
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
     */
    public function test_it_has_basic_data_with_labels_and_colors(): void
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30])->backgroundColor(['red', 'green', 'blue']),
            (new Dataset)->data([30, 20, 10])->backgroundColor(['red', 'green', 'blue'])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $expected = [
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
     * Test if the beginAtZero helper emits Chart.js 3+ scale syntax.
     */
    public function test_can_set_start_from_zero_using_helper(): void
    {
        $data = new Data;

        $datasets = [
            (new Dataset)->data([10, 20, 30])->backgroundColor(['red', 'green', 'blue'])
        ];

        $data->datasets($datasets)->labels(['Red', 'Green', 'Blue']);

        $this->chart->data($data);

        $this->chart->beginAtZero();

        $expected = [
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
                    'y' => [
                        'beginAtZero' => true
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $this->chart->get());
    }

    /**
     * Test if beginAtZero merges into existing scales instead of replacing them.
     */
    public function test_begin_at_zero_preserves_existing_scales(): void
    {
        $this->chart->options->scales = [
            'x' => ['grid' => ['display' => false]],
            'y' => ['max' => 100],
        ];

        $this->chart->beginAtZero();

        $this->assertEquals([
            'x' => ['grid' => ['display' => false]],
            'y' => ['max' => 100, 'beginAtZero' => true],
        ], $this->chart->options->scales);
    }

    /**
     * Test if the chart can create mixed chart types.
     */
    public function test_can_create_mixed_chart_types(): void
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
    public function test_can_set_dataset_as_an_array(): void
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
    public function test_invalid_json_throws_exception(): void
    {
        $this->expectException(JsonException::class);

        // Create an invalid UTF-8 sequence to force JSON encoding error
        $data = new Data();
        $dataset = new Dataset();
        $dataset->data = ["\xFF"]; // Invalid UTF-8 sequence
        $data->datasets([$dataset]);

        $this->chart->data($data);
        $this->chart->toJson();
    }

    /**
     * A chart without a type must omit "type" from its array and JSON
     * output, and empty data/options must encode as JSON objects, not
     * arrays, to match the config shape Chart.js expects.
     */
    public function test_empty_chart_serializes_to_json_objects(): void
    {
        $this->assertSame('{"data":{},"options":{}}', $this->chart->toJson());
        $this->assertSame(['data' => [], 'options' => []], $this->chart->toArray());

        $this->chart->type = 'line';

        $this->assertSame('{"type":"line","data":{},"options":{}}', $this->chart->toJson());
    }

    /**
     * Serialization must not mutate the object graph: after toArray() the
     * nested Dataset objects must stay objects, so later changes to them
     * are still reflected in subsequent serializations.
     */
    public function test_to_array_does_not_mutate_nested_objects(): void
    {
        $dataset = (new Dataset)->data([1, 2, 3]);

        $data = new Data;
        $data->datasets([$dataset]);

        $data->toArray();

        $dataset->label('added later');

        $this->assertEquals([
            'datasets' => [
                ['data' => [1, 2, 3], 'label' => 'added later'],
            ],
        ], $data->toArray());
    }

    /**
     * PHP array copies share reference slots, and &__get() creates such
     * slots — serialization must stay non-mutating even when the caller
     * holds a reference into the attributes.
     */
    public function test_to_array_does_not_mutate_through_held_references(): void
    {
        $data = new Data;

        $datasets = &$data->datasets;
        $datasets[] = (new Dataset)->data([1]);

        $data->toArray();

        $this->assertInstanceOf(Dataset::class, $data->datasets[0]);
    }

    /**
     * References can also point at elements *inside* an attribute array;
     * serialization must not write through them either.
     */
    public function test_to_array_does_not_mutate_through_element_references(): void
    {
        $data = new Data;

        $datasets = &$data->datasets;
        $datasets[] = (new Dataset)->data([1]);
        $first = &$datasets[0];

        $data->toArray();

        $this->assertInstanceOf(Dataset::class, $first);
        $this->assertInstanceOf(Dataset::class, $data->datasets[0]);
    }

    /**
     * A cloned config must not share state with the original, even through
     * reference slots created by &__get().
     */
    public function test_cloned_config_does_not_share_state(): void
    {
        $original = new Data;

        $ref = &$original->datasets;
        $ref[] = 'first';

        $copy = clone $original;
        $copy->datasets[] = 'second';

        $this->assertSame(['datasets' => ['first']], $original->toArray());
        $this->assertSame(['datasets' => ['first', 'second']], $copy->toArray());
    }

    /**
     * Cloning a chart must clone its data and options too.
     */
    public function test_cloned_chart_does_not_share_data_and_options(): void
    {
        $this->chart->data->labels(['a']);

        $copy = clone $this->chart;
        $copy->data->labels(['b']);
        $copy->options->responsive(true);

        $this->assertSame(['labels' => ['a']], $this->chart->data->toArray());
        $this->assertSame([], $this->chart->options->toArray());
        $this->assertSame(['labels' => ['b']], $copy->data->toArray());
    }

    /**
     * isset(), empty() and unset() must work on magic config properties.
     */
    public function test_isset_and_unset_work_on_magic_properties(): void
    {
        $data = new Data;

        $this->assertFalse(isset($data->labels));
        $this->assertTrue(empty($data->labels));

        $data->labels = ['Red'];

        $this->assertTrue(isset($data->labels));
        $this->assertFalse(empty($data->labels));

        unset($data->labels);

        $this->assertFalse(isset($data->labels));
        $this->assertSame([], $data->toArray());
    }

    /**
     * Reading a property that was never set must not leak a null entry
     * into the serialized output.
     */
    public function test_reading_missing_property_does_not_leak_into_output(): void
    {
        $data = new Data;

        // @phpstan-ignore property.notFound (reading an undeclared magic property is the point of this test)
        $this->assertNull($data->missing);
        $this->assertSame([], $data->toArray());
    }

    /**
     * An explicitly assigned null is intentional and must be kept.
     */
    public function test_explicit_null_is_kept_in_output(): void
    {
        $options = new Options;
        // @phpstan-ignore property.notFound (assigning an undeclared magic property is the point of this test)
        $options->borderColor = null;

        $this->assertSame(['borderColor' => null], $options->toArray());
    }

    /**
     * Calling a magic setter without arguments must throw instead of
     * silently assigning false.
     */
    public function test_magic_call_without_arguments_throws(): void
    {
        $this->expectException(ArgumentCountError::class);

        // @phpstan-ignore arguments.count (calling without arguments is the point of this test)
        (new Options)->responsive();
    }

    /**
     * Extra arguments must throw too — silently discarding them teaches
     * callers the signature is validated when it is not.
     */
    public function test_magic_call_with_extra_arguments_throws(): void
    {
        $this->expectException(ArgumentCountError::class);

        // @phpstan-ignore arguments.count (passing extra arguments is the point of this test)
        (new Options)->responsive(true, false);
    }

    /**
     * With __isset() in place, null coalescing must respect set properties
     * instead of always producing the fallback.
     */
    public function test_null_coalescing_respects_set_properties(): void
    {
        $options = new Options;

        $this->assertSame('fallback', $options->indexAxis ?? 'fallback');

        $options->responsive = false;

        $this->assertFalse($options->responsive ?? true);
    }

    /**
     * Test if element ids are validated before being embedded in HTML.
     */
    #[DataProvider('invalidElementIds')]
    public function test_html_rejects_invalid_element_ids(string $invalidId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->chart->toHtml($invalidId);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidElementIds(): array
    {
        return [
            'script injection' => ['"><script>alert("xss")</script>'],
            'leading digit' => ['1chart'],
            'space' => ['my chart'],
            'empty string' => [''],
            'trailing newline' => ["chart\n"],
        ];
    }

    /**
     * Test if the unique id suffix can be disabled so the element keeps
     * the exact id the caller asked for.
     */
    public function test_html_uses_element_id_verbatim_when_suffix_disabled(): void
    {
        $html = $this->chart->toHtml('my_chart', false);

        $this->assertStringContainsString('<canvas id="my_chart"></canvas>', $html);
        $this->assertStringContainsString('document.getElementById("my_chart")', $html);
    }

    /**
     * Test if generated element ids are unique across renders.
     */
    public function test_element_ids_are_unique(): void
    {
        $html1 = $this->chart->toHtml('my-chart');
        $html2 = $this->chart->toHtml('my-chart');

        preg_match('/id="(my-chart_[0-9a-f]{12})"/', $html1, $matches1);
        preg_match('/id="(my-chart_[0-9a-f]{12})"/', $html2, $matches2);

        $this->assertNotEmpty($matches1, 'Expected a random-suffixed id in the output');
        $this->assertNotEmpty($matches2, 'Expected a random-suffixed id in the output');
        $this->assertNotEquals($matches1[1], $matches2[1]);
    }

    /**
     * Cleanup must use pagehide (unload is deprecated and defeats the
     * back/forward cache) and must keep the chart alive when the page is
     * merely suspended into the bfcache.
     */
    public function test_chart_cleanup_uses_pagehide(): void
    {
        $html = $this->chart->toHtml('test-chart', false);

        $this->assertStringContainsString('window.addEventListener("pagehide"', $html);
        $this->assertStringContainsString('event.persisted', $html);
        $this->assertStringContainsString('.destroy()', $html);
        $this->assertStringNotContainsString('"unload"', $html);
    }

    /**
     * Test if chart instances are registered for external access.
     */
    public function test_chart_instances_are_tracked(): void
    {
        $html = $this->chart->toHtml('test-chart', false);

        $this->assertStringContainsString('window.bbsnlyChartJSInstances', $html);
        $this->assertStringContainsString('window.bbsnlyChartJSInstances["test-chart"] = chart', $html);
        $this->assertStringContainsString('delete window.bbsnlyChartJSInstances["test-chart"]', $html);
    }

    /**
     * The chart config produced by toJson() must be embedded verbatim in
     * the generated JavaScript.
     */
    public function test_html_embeds_chart_config_json(): void
    {
        $this->chart->type = 'line';

        $html = $this->chart->toHtml('embed-test', false);

        $this->assertStringContainsString('new Chart(canvas, {"type":"line","data":{},"options":{}})', $html);
    }

    /**
     * A hostile label must not be able to close the script block early:
     * the only literal </script> in the output is the real closing tag.
     */
    public function test_html_contains_single_script_block_with_hostile_labels(): void
    {
        $data = new Data;
        $data->labels(['</script><script>alert(1)</script>']);
        $this->chart->data($data);

        $html = $this->chart->toHtml('hostile', false);

        $this->assertSame(1, substr_count($html, '</script>'));
    }

    /**
     * Test if error handling for missing canvas is present
     */
    public function test_canvas_error_handling(): void
    {
        $html = $this->chart->toHtml('test-chart');

        $this->assertStringContainsString('if (!canvas)', $html);
        $this->assertStringContainsString('console.error', $html);
    }

    /**
     * Test if JSON output properly escapes HTML characters
     */
    public function test_json_escapes_html_characters(): void
    {
        $data = new Data;
        $datasets = [
            (new Dataset)->data([1])->label('<script>alert("xss")</script>')
        ];
        $data->datasets($datasets);
        $this->chart->data($data);

        $json = $this->chart->toJson();

        $this->assertStringNotContainsString('<script>', $json);
        $this->assertStringContainsString('\\u003Cscript\\u003E', $json);
    }

    /**
     * Test if Config class get() and toJson() methods work correctly
     */
    public function test_config_get_and_tojson_methods(): void
    {
        $config = new Config(['key' => 'value']);

        $this->assertEquals(['key' => 'value'], $config->get());
        $this->assertEquals('{"key":"value"}', $config->toJson());
    }

    /**
     * Regression test for issue #34: `$data->datasets[] = ...; PHP error`.
     *
     * Appending to a not-yet-existing magic property must mutate the real
     * underlying array. This relies on Config::&__get() returning the
     * attribute by reference. Without it PHP raises
     * "Indirect modification of overloaded property ... has no effect"
     * (which PHPUnit turns into a failure) and the append is silently lost.
     */
    public function test_it_can_append_to_a_magic_array_property(): void
    {
        $data = new Data();

        // Property does not exist yet — append must create and grow the array.
        $data->datasets[] = (new Dataset)->data([10, 20, 30]);
        $data->datasets[] = (new Dataset)->data([30, 20, 10]);

        $this->assertCount(2, $data->datasets);
        $this->assertEquals(
            [
                'datasets' => [
                    ['data' => [10, 20, 30]],
                    ['data' => [30, 20, 10]],
                ],
            ],
            $data->toArray()
        );
    }
}
