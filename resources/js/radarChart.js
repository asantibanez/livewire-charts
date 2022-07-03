
const radarChart = () => {
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

            const jsonOptions = component.get('radarChartModel.jsonOptions') || '{}';

            const options = JSON.parse(jsonOptions);

            this.applyFixedOptions(options, component);
            this.applyFluentOptions(options, component);
            this.applyEvents(options, component);
            this.applyNumberFormatting(options, component);

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        },

        applyFixedOptions(options, component) {
            const data = component.get('radarChartModel.data');
            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => item.value)
                }));

            nestedProperty.set(options, 'chart.type', 'radar');
            nestedProperty.set(options, 'chart.height', '100%');
            nestedProperty.set(options, 'chart.toolbar.show', false);
            nestedProperty.set(options, 'plotOptions.bar.horizontal', false);
            nestedProperty.set(options, 'plotOptions.bar.columnWidth', '50%');
            nestedProperty.set(options, 'markers.size', 4);

            nestedProperty.set(options, 'series', series);
            nestedProperty.set(options, 'xAxis.categories', data[series[0].name].map(item => item.title));
        },

        applyFluentOptions(options, component) {
            const animated = component.get('radarChartModel.animated');
            const categories = component.get('radarChartModel.xAxis.categories');
            const colors = component.get('radarChartModel.colors');
            const dataLabels = component.get('radarChartModel.dataLabels');
            const legend = component.get('radarChartModel.legend');
            const opacity = component.get('radarChartModel.opacity');
            const sparkline = component.get('radarChartModel.sparkline');
            const title = component.get('radarChartModel.title');

            if (! nestedProperty.has(options, 'chart.animations')) {
                nestedProperty.set(options, 'chart.animations.enabled', animated);
            }

            if (categories && categories.length > 0) {
                nestedProperty.set(options, 'xaxis.categories', categories);
            }

            if (! nestedProperty.has(options, 'colors')) {
                nestedProperty.set(options, 'colors', colors);
            }

            if (! nestedProperty.has(options, 'dataLabels')) {
                nestedProperty.set(options, 'dataLabels.enabled', dataLabels);
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

            if (! nestedProperty.has(options, 'title.text')) {
                nestedProperty.set(options, 'title.text', title);
            }
        },

        applyEvents(options, component) {
            const onPointClickEventName = component.get('radarChartModel.onPointClickEventName');
            const data = component.get('radarChartModel.data');
            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => item.value)
                }));

            const events = {
                markerClick: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                    if (! onPointClickEventName) {
                        return
                    }

                    const point = data[series[seriesIndex].name][dataPointIndex]

                    component.call('onPointClick', point)
                },
            };

            nestedProperty.set(options, 'chart.events', events);
        },

        applyNumberFormatting(options, component) {
            const numberFormat = component.get('radarChartModel.numberFormat');

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

export default radarChart
