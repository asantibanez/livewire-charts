
const multiColumnChart = () => {
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

            const jsonOptions = component.get('columnChartModel.jsonOptions') || '{}';

            const options = JSON.parse(jsonOptions);

            this.applyFixedOptions(options, component);
            this.applyFluentOptions(options, component);
            this.applyEvents(options, component);
            this.applyNumberFormatting(options, component);

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        },

        applyFixedOptions(options, component) {
            const data = component.get('columnChartModel.data');
            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => item.value)
                }));
            const categories = data[series[0].name].map(item => item.title);

            nestedProperty.set(options, 'chart.type', 'bar');
            nestedProperty.set(options, 'chart.height', '100%');
            nestedProperty.set(options, 'chart.toolbar.show', false);
            nestedProperty.set(options, 'series', series);
            nestedProperty.set(options, 'xaxis.categories', categories);
        },

        applyFluentOptions(options, component) {
            const animated = component.get('columnChartModel.animated');
            const categories = component.get('columnChartModel.xAxis.categories');
            const colors = component.get('columnChartModel.colors');
            const columnWidth = component.get('columnChartModel.columnWidth');
            const dataLabels = component.get('columnChartModel.dataLabels');
            const grid = component.get('columnChartModel.grid');
            const horizontal = component.get('columnChartModel.horizontal');
            const stacked = component.get('columnChartModel.isStacked');
            const legend = component.get('columnChartModel.legend');
            const opacity = component.get('columnChartModel.opacity');
            const sparkline = component.get('columnChartModel.sparkline');
            const title = component.get('columnChartModel.title');

            if (! nestedProperty.has(options, 'chart.animations')) {
                nestedProperty.set(options, 'chart.animations.enabled', animated);
            }

            if (categories && categories.length > 0) {
                nestedProperty.set(options, 'xaxis.categories', categories);
            }

            if (colors && colors.length > 0) {
                nestedProperty.set(options, 'colors', colors);
            }

            if (! nestedProperty.has(options, 'plotOptions.bar.columnWidth')) {
                nestedProperty.set(options, 'plotOptions.bar.columnWidth', `${columnWidth}%`);
            }

            if (! nestedProperty.has(options, 'dataLabels')) {
                nestedProperty.set(options, 'dataLabels.enabled', dataLabels);
            }

            if (! nestedProperty.has(options, 'grid')) {
                nestedProperty.set(options, 'grid', grid);
            }

            if (! nestedProperty.has(options, 'plotOptions.bar.horizontal')) {
                nestedProperty.set(options, 'plotOptions.bar.horizontal', horizontal);
            }

            if (! nestedProperty.has(options, 'chart.stacked')) {
                nestedProperty.set(options, 'chart.stacked', stacked);
            }

            if (! nestedProperty.has(options, 'legend')) {
                nestedProperty.set(options, 'legend', legend);
            }

            if (! nestedProperty.has(options, 'fill.opacity')) {
                nestedProperty.set(options, 'fill.opacity', opacity);
            }

            if (! nestedProperty.has(options, 'chart.sparkline')) {
                nestedProperty.set(options, 'chart.sparkline.enabled', sparkline);
            }

            if (! nestedProperty.has(options, 'yaxis.title.text')) {
                nestedProperty.set(options, 'yaxis.title.text', title);
            }
        },

        applyEvents(options, component) {
            const onColumnClickEventName = component.get('columnChartModel.onColumnClickEventName');
            const data = component.get('columnChartModel.data');
            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => item.value)
                }));

            const events = {
                dataPointSelection: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                    if (! onColumnClickEventName) {
                        return
                    }

                    const column = data[series[seriesIndex].name][dataPointIndex]
                    component.call('onColumnClick', column)
                },
            };

            nestedProperty.set(options, 'chart.events', events);
        },

        applyNumberFormatting(options, component) {
            const numberFormat = component.get('columnChartModel.numberFormat');

            const formats = new Map();
            formats.set('number', value => value.toLocaleString());
            formats.set('dollar', value => "$" + value.toLocaleString());
            formats.set('percentage', value => value.toLocaleString() + "%");

            // Apply formatting...
            nestedProperty.set(options, 'dataLabels.formatter', function (value) {
                return formats.get(numberFormat)(value);
            });

            nestedProperty.set(options, 'yaxis.labels.formatter', function (value) {
                return formats.get(numberFormat)(value);
            });
        }
    }
}

export default multiColumnChart
