<?php

namespace Asantibanez\LivewireCharts\Tests;

use Asantibanez\LivewireCharts\Formatters;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use InvalidArgumentException;

class JsonConfigTest extends TestCase
{
    private function makeModel(): LineChartModel
    {
        return new LineChartModel();
    }

    // -------------------------------------------------------------------------
    // Plain scalar values — accepted
    // -------------------------------------------------------------------------

    /** @test */
    public function accepts_integer_values()
    {
        $model = $this->makeModel()->setJsonConfig([
            'plotOptions.pie.startAngle' => -90,
            'plotOptions.pie.endAngle'   => 90,
        ]);

        $this->assertSame(-90, $model->toArray()['jsonConfig']['plotOptions.pie.startAngle']);
        $this->assertSame(90,  $model->toArray()['jsonConfig']['plotOptions.pie.endAngle']);
    }

    /** @test */
    public function accepts_float_values()
    {
        $model = $this->makeModel()->setJsonConfig([
            'chart.zoom.autoScaleYaxis' => 1.5,
        ]);

        $this->assertSame(1.5, $model->toArray()['jsonConfig']['chart.zoom.autoScaleYaxis']);
    }

    /** @test */
    public function accepts_boolean_values()
    {
        $model = $this->makeModel()->setJsonConfig([
            'chart.toolbar.show' => false,
            'dataLabels.enabled' => true,
        ]);

        $this->assertFalse($model->toArray()['jsonConfig']['chart.toolbar.show']);
        $this->assertTrue($model->toArray()['jsonConfig']['dataLabels.enabled']);
    }

    /** @test */
    public function accepts_plain_string_values()
    {
        $model = $this->makeModel()->setJsonConfig([
            'chart.type' => 'bar',
        ]);

        $this->assertSame('bar', $model->toArray()['jsonConfig']['chart.type']);
    }

    /** @test */
    public function accepts_array_values()
    {
        $model = $this->makeModel()->setJsonConfig([
            'colors' => ['#FF0000', '#00FF00'],
        ]);

        $this->assertSame(['#FF0000', '#00FF00'], $model->toArray()['jsonConfig']['colors']);
    }

    // -------------------------------------------------------------------------
    // Valid formatter constants — accepted
    // -------------------------------------------------------------------------

    /** @test */
    public function accepts_currency_formatter_constant()
    {
        $model = $this->makeModel()->setJsonConfig([
            'tooltip.y.formatter' => Formatters::CURRENCY,
        ]);

        $this->assertSame(Formatters::CURRENCY, $model->toArray()['jsonConfig']['tooltip.y.formatter']);
    }

    /** @test */
    public function accepts_all_formatter_constants()
    {
        $constants = [
            Formatters::CURRENCY,
            Formatters::PERCENT,
            Formatters::INTEGER,
            Formatters::DECIMAL,
        ];

        foreach ($constants as $constant) {
            $model = $this->makeModel()->setJsonConfig(['tooltip.y.formatter' => $constant]);
            $this->assertSame($constant, $model->toArray()['jsonConfig']['tooltip.y.formatter']);
        }
    }

    // -------------------------------------------------------------------------
    // Raw JS strings — rejected
    // -------------------------------------------------------------------------

    /** @test */
    public function rejects_arrow_function_string()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/no longer accepts raw JavaScript/');

        $this->makeModel()->setJsonConfig([
            'tooltip.y.formatter' => '(val) => `$${val} million dollars baby!`',
        ]);
    }

    /** @test */
    public function rejects_function_keyword_string()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/no longer accepts raw JavaScript/');

        $this->makeModel()->setJsonConfig([
            'tooltip.y.formatter' => 'function(val) { return val + " units"; }',
        ]);
    }

    // -------------------------------------------------------------------------
    // Unknown formatter name — rejected
    // -------------------------------------------------------------------------

    /** @test */
    public function rejects_unknown_formatter_prefix()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/unknown formatter/');

        $this->makeModel()->setJsonConfig([
            'tooltip.y.formatter' => 'formatter:nonexistent',
        ]);
    }

    /** @test */
    public function error_message_lists_available_formatters()
    {
        try {
            $this->makeModel()->setJsonConfig([
                'tooltip.y.formatter' => 'formatter:nonexistent',
            ]);
            $this->fail('Expected InvalidArgumentException was not thrown');
        } catch (InvalidArgumentException $e) {
            foreach (Formatters::known() as $name) {
                $this->assertStringContainsString($name, $e->getMessage());
            }
        }
    }
}
