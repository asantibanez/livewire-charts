
const areaChart = () => {
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

            const jsonOptions = component.get('areaChartModel.jsonOptions') || '{}';

            const options = JSON.parse(jsonOptions);

            this.applyFixedOptions(options, component);
            this.applyFluentOptions(options, component);
            this.applyEvents(options, component);
            this.applyNumberFormatting(options, component);

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        },

        applyFixedOptions(options, component) {
            const title = component.get('areaChartModel.title');
            const data = component.get('areaChartModel.data');
            const series = [{
                name: title,
                data: data.map(item => item.value)
            }];

            nestedProperty.set(options, 'chart.type', 'area');
            nestedProperty.set(options, 'chart.height', '100%');
            nestedProperty.set(options, 'chart.zoom.enabled', false);
            nestedProperty.set(options, 'chart.toolbar.show', false);
            nestedProperty.set(options, 'title.align', 'center');
            nestedProperty.set(options, 'grid.padding.left', 0);
            nestedProperty.set(options, 'grid.padding.top', 0);
            nestedProperty.set(options, 'grid.padding.right', 0);
            nestedProperty.set(options, 'grid.padding.bottom', 0);

            nestedProperty.set(options, 'series', series);
            nestedProperty.set(options, 'xaxis.categories', data.map(item => item.title));
            nestedProperty.set(options, 'labels', data.map(item => item.title));
        },

        applyFluentOptions(options, component) {
            const animated = component.get('areaChartModel.animated');
            const categories = component.get('areaChartModel.xAxis.categories');
            const colors = component.get('areaChartModel.color');
            const dataLabels = component.get('areaChartModel.dataLabels');
            const sparkline = component.get('areaChartModel.sparkline');
            const stroke = component.get('areaChartModel.stroke');
            const title = component.get('areaChartModel.title');
            const xaxisLabels = component.get('areaChartModel.xAxis.labels');
            const yaxis = component.get('areaChartModel.yAxis');

            if (! nestedProperty.has(options, 'chart.animations')) {
                nestedProperty.set(options, 'chart.animations.enabled', animated);
            }

            if (categories && categories.length > 0) {
                nestedProperty.set(options, 'xaxis.categories', categories);
            }

            if (! nestedProperty.has(options, 'colors')) {
                nestedProperty.set(options, 'colors', [colors || '#2E93fA']);   // TODO
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
            const onPointClickEventName = component.get('areaChartModel.onPointClickEventName')
            const data = component.get('areaChartModel.data');

            const events = {
                markerClick: function(event, chartContext, { dataPointIndex }) {
                    if (! onPointClickEventName) {
                        return
                    }

                    const point = data[dataPointIndex]
                    component.call('onPointClick', point)
                }
            };

            nestedProperty.set(options, 'chart.events', events);
        },

        applyNumberFormatting(options, component) {
            const numberFormat = component.get('areaChartModel.numberFormat');

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

export default areaChart
