import deepmerge from 'deepmerge'

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

export const mergedOptionsWithJsonConfig = (options, jsonConfig) => {
    const customOptions = Object.keys(jsonConfig)
        .reduce(function (obj, key) {
            const value = jsonConfig[key]

            // Assume `value` is now directly a function or other proper JS type
            // No need for eval(), just directly use the value
            return addPathToObjectWithValue(obj, key, value)
        }, {})

    return deepmerge(options, customOptions)
}
