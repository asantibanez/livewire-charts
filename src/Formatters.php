<?php

namespace Asantibanez\LivewireCharts;

/**
 * Named formatter constants for use with setJsonConfig().
 *
 * Pass one of these constants as the value for any dot-notation key that
 * requires an Apex formatter callback. The JS runtime resolves each name
 * to a pre-built function from the package formatter registry — no eval
 * or dynamic code generation is involved.
 *
 * Example:
 *   $chart->setJsonConfig([
 *       'tooltip.y.formatter' => \Asantibanez\LivewireCharts\Formatters::CURRENCY,
 *   ]);
 */
final class Formatters
{
    /** Dollar-formatted value, e.g. 1234.5 → "$1,234.50" */
    const CURRENCY = 'formatter:currency';

    /** Percentage, e.g. 42 → "42%" */
    const PERCENT = 'formatter:percent';

    /** Rounded integer, e.g. 42.7 → "43" */
    const INTEGER = 'formatter:integer';

    /** Two decimal places, e.g. 3.14159 → "3.14" */
    const DECIMAL = 'formatter:decimal';

    /**
     * Returns all known formatter names (without the "formatter:" prefix).
     * Used internally by HasJsonConfig to validate references.
     *
     * @return string[]
     */
    public static function known()
    {
        return ['currency', 'percent', 'integer', 'decimal'];
    }
}
