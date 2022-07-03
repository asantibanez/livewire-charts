
const multiLineChart = () => {
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

            const jsonOptions = component.get('lineChartModel.jsonOptions') || '{}';

            const options = JSON.parse(jsonOptions);

            this.applyFixedOptions(options, component);
            this.applyFluentOptions(options, component);
            this.applyEvents(options, component);
            this.applyNumberFormatting(options, component);

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        },

        applyFixedOptions(options, component) {
            const data = component.get('lineChartModel.data');

            const series = Object.keys(data).map(key => {
                return {
                    name: key,
                    data: data[key].map(item => item.value),
                }
            });

            nestedProperty.set(options, 'chart.type', 'line');
            nestedProperty.set(options, 'chart.height', '100%');
            nestedProperty.set(options, 'chart.zoom.enabled', false);
            nestedProperty.set(options, 'chart.toolbar.show', false);
            nestedProperty.set(options, 'title.align', 'center');

            nestedProperty.set(options, 'series', series);
            nestedProperty.set(options, 'xaxis.categories', data[series[0].name].map(item => item.title));
        },

        applyFluentOptions(options, component) {
            const animated = component.get('lineChartModel.animated');
            const categories = component.get('lineChartModel.xAxis.categories');
            const colors = component.get('lineChartModel.colors');
            const dataLabels = component.get('lineChartModel.dataLabels');
            const sparkline = component.get('lineChartModel.sparkline');
            const stroke = component.get('lineChartModel.stroke');
            const title = component.get('lineChartModel.title');
            const xaxisLabels = component.get('lineChartModel.xAxis.labels');
            const yaxis = component.get('lineChartModel.yAxis');

            if (! nestedProperty.has(options, 'chart.animations')) {
                nestedProperty.set(options, 'chart.animations.enabled', animated);
            }

            if (categories && categories.length > 0) {
                nestedProperty.set(options, 'xaxis.categories', categories);
            }

            if (colors && colors.length > 0) {
                nestedProperty.set(options, 'colors', colors);
            }

            if (! nestedProperty.has(options, 'dataLabels')) {
                nestedProperty.set(options, 'dataLabels.enabled', dataLabels);
            }

            if (! nestedProperty.has(options, 'chart.sparkline')) {
                nestedProperty.set(options, 'chart.sparkline.enabled', sparkline);
            }

            if (! nestedProperty.has(options, 'stroke')) {
                nestedProperty.set(options, 'stroke', stroke);
            }

            if (! nestedProperty.has(options, 'title.text')) {
                nestedProperty.set(options, 'title.text', title);
            }

            if (! nestedProperty.has(options, 'xaxis.labels')) {
                nestedProperty.set(options, 'xaxis.labels', xaxisLabels);
            }

            if (! nestedProperty.has(options, 'yaxis')) {
                nestedProperty.set(options, 'yaxis', yaxis);
            }
        },

        applyEvents(options, component) {
            const onPointClickEventName = component.get('lineChartModel.onPointClickEventName');
            const data = component.get('lineChartModel.data');
            const series = Object.keys(data).map(key => {
                return {
                    name: key,
                    data: data[key].map(item => item.value),
                }
            });

            const events = {
                markerClick: function(event, chartContext, { seriesIndex, dataPointIndex }) {
                    if (! onPointClickEventName) {
                        return
                    }

                    const point = data[series[seriesIndex].name][dataPointIndex]
                    component.call('onPointClick', point)
                }
            };

            nestedProperty.set(options, 'chart.events', events);
        },

        applyNumberFormatting(options, component) {
            const numberFormat = component.get('lineChartModel.numberFormat');

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

export default multiLineChart
