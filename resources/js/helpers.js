import deepmerge from 'deepmerge'
import { formatters } from './formatters'

export const addPathToObjectWithValue = (obj, path, value) => {
    const pList = path.split('.');
    const key = pList.pop();
    const pointer = pList.reduce((accumulator, currentValue) => {
        if (accumulator[currentValue] === undefined) accumulator[currentValue] = {};
        return accumulator[currentValue];
    }, obj);
    pointer[key] = value;
    return obj;
}

const FORMATTER_PREFIX = 'formatter:'

/**
 * Resolve a single jsonConfig value.
 *
 * - Plain scalars (number, boolean, array, non-prefixed string) are returned as-is.
 * - Strings starting with "formatter:" are resolved to a function from the
 *   package-owned formatters registry. An unknown name throws immediately so
 *   the misconfiguration surfaces at chart-render time rather than silently
 *   producing a broken chart.
 *
 * No eval / new Function is used.
 */
const resolveConfigValue = (key, value) => {
    if (typeof value !== 'string' || !value.startsWith(FORMATTER_PREFIX)) {
        return value
    }

    const name = value.slice(FORMATTER_PREFIX.length)

    if (!Object.prototype.hasOwnProperty.call(formatters, name)) {
        throw new Error(
            'livewire-charts: unknown formatter "' + name + '" for "' + key + '". ' +
            'Available: ' + Object.keys(formatters).join(', ') + '.'
        )
    }

    return formatters[name]
}

export const mergedOptionsWithJsonConfig = (options, jsonConfig) => {
    const customOptions = Object.keys(jsonConfig)
        .reduce(function (obj, key) {
            return addPathToObjectWithValue(obj, key, resolveConfigValue(key, jsonConfig[key]))
        }, {})

    return deepmerge(options, customOptions)
}
