/**
 * Package-owned formatter registry for use with setJsonConfig().
 *
 * PHP callers should reference these via the Formatters constants class:
 *   \Asantibanez\LivewireCharts\Formatters::CURRENCY  // 'formatter:currency'
 *   \Asantibanez\LivewireCharts\Formatters::PERCENT   // 'formatter:percent'
 *   \Asantibanez\LivewireCharts\Formatters::INTEGER   // 'formatter:integer'
 *   \Asantibanez\LivewireCharts\Formatters::DECIMAL   // 'formatter:decimal'
 *
 * The object is frozen so no external code can inject new entries at runtime.
 */
export const formatters = Object.freeze({
    /** Dollar-formatted value, e.g. 1234.5 → "$1,234.50" */
    currency: (val) => '$' + Number(val).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }),

    /** Percentage, e.g. 42 → "42%" */
    percent: (val) => val + '%',

    /** Rounded integer, e.g. 42.7 → "43" */
    integer: (val) => String(Math.round(Number(val))),

    /** Two decimal places, e.g. 3.14159 → "3.14" */
    decimal: (val) => Number(val).toFixed(2),
})
