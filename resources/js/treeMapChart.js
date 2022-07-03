
const treeMapChart = () => {
    return {
        chart: null,

        init() {
            setTimeout(() => {
                this.drawChart(this.$wire)
            }, 0)
        },

        drawChart(component) {
            if (this.chart) {
                this.chart.destroy()
            }

            const jsonOptions = component.get('treeMapChartModel.jsonOptions') || '{}';

            const options = JSON.parse(jsonOptions);

            this.applyFixedOptions(options, component);
            this.applyFluentOptions(options, component);
            this.applyEvents(options, component);
            this.applyNumberFormatting(options, component);

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        },

        applyFixedOptions(options, component) {
            const data = component.get('treeMapChartModel.data');

            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => ({
                        x: item.title,
                        y: item.value,
                    }))
                }));

            nestedProperty.set(options, 'chart.type', 'treemap');
            nestedProperty.set(options, 'chart.height', '100%');
            nestedProperty.set(options, 'chart.toolbar.show', false);
            nestedProperty.set(options, 'legend.show', false);

            nestedProperty.set(options, 'series', series);
        },

        applyFluentOptions(options, component) {
            const animated = component.get('treeMapChartModel.animated');
            const colors = component.get('treeMapChartModel.colors');
            const distributed = component.get('treeMapChartModel.distributed');
            const enableShades = component.get('treeMapChartModel.enableShades');
            const title = component.get('treeMapChartModel.title');

            if (! nestedProperty.has(options, 'chart.animations')) {
                nestedProperty.set(options, 'chart.animations.enabled', animated);
            }

            if (! nestedProperty.has(options, 'colors')) {
                nestedProperty.set(options, 'colors', colors);
            }

            if (! nestedProperty.has(options, 'plotOptions.treemap.distributed')) {
                nestedProperty.set(options, 'plotOptions.treemap.distributed', distributed);
            }

            if (! nestedProperty.has(options, 'plotOptions.treemap.enableShades')) {
                nestedProperty.set(options, 'plotOptions.treemap.enableShades', enableShades);
            }

            if (! nestedProperty.has(options, 'title.text')) {
                nestedProperty.set(options, 'title.text', title);
            }
        },

        applyEvents(options, component) {
            const onBlockClickEventName = component.get('treeMapChartModel.onBlockClickEventName');
            const data = component.get('treeMapChartModel.data');
            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => ({
                        x: item.title,
                        y: item.value,
                    }))
                }));

            const events = {
                click: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                    if (! onBlockClickEventName) {
                        return
                    }

                    const block = data[series[seriesIndex].name][dataPointIndex]

                    component.emit(onBlockClickEventName, block)
                },
            };

            nestedProperty.set(options, 'chart.events', events);
        },

        applyNumberFormatting(options, component) {
            const numberFormat = component.get('treeMapChartModel.numberFormat');

            const formats = new Map();
            formats.set('number', value => value.toLocaleString());
            formats.set('dollar', value => "$" + value.toLocaleString());
            formats.set('percentage', value => value.toLocaleString() + "%");

            // Apply formatting...
            nestedProperty.set(options, 'yaxis.labels.formatter', function (value) {
                return formats.get(numberFormat)(value);
            });
        }
    }
}

export default treeMapChart
