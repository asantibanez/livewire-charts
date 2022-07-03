
const pieChart = () => {
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

            const jsonOptions = component.get('pieChartModel.jsonOptions') || '{}';

            const options = JSON.parse(jsonOptions);

            this.applyFixedOptions(options, component);
            this.applyFluentOptions(options, component);
            this.applyEvents(options, component);
            this.applyNumberFormatting(options, component);

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        },

        applyFixedOptions(options, component) {
            const data = component.get('pieChartModel.data')

            if (! nestedProperty.has(options, 'chart.type')) {
                nestedProperty.set(options, 'chart.type', 'pie');
            }

            nestedProperty.set(options, 'chart.height', '100%');
            nestedProperty.set(options, 'title.align', 'center');
            nestedProperty.set(options, 'responsive.0.breakpoint', 600);
            nestedProperty.set(options, 'responsive.0.options.legend.position', 'bottom');

            nestedProperty.set(options, 'series', data.map(item => item.value));
            nestedProperty.set(options, 'labels', data.map(item => item.title));
            nestedProperty.set(options, 'colors', data.map(item => item.color));
        },

        applyFluentOptions(options, component) {
            const animated = component.get('pieChartModel.animated');
            const colors = component.get('pieChartModel.colors');
            const dataLabels = component.get('pieChartModel.dataLabels');
            const legend = component.get('pieChartModel.legend');
            const opacity = component.get('pieChartModel.opacity');
            const sparkline = component.get('pieChartModel.sparkline');
            const title = component.get('pieChartModel.title');
            const type = component.get('pieChartModel.type');

            if (! nestedProperty.has(options, 'chart.animations')) {
                nestedProperty.set(options, 'chart.animations.enabled', animated);
            }

            if (colors && colors.length > 0) {
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

            if (type !== 'pie') {
                nestedProperty.set(options, 'chart.type', type);
            }
        },

        applyEvents(options, component) {
            const onSliceClickEventName = component.get('pieChartModel.onSliceClickEventName')
            const data = component.get('pieChartModel.data')

            const events = {
                dataPointSelection: function(event, chartContext, config) {
                    if (! onSliceClickEventName) {
                        return
                    }

                    const { dataPointIndex } = config
                    const slice = data[dataPointIndex]
                    component.call('onSliceClick', slice)
                },
            };

            nestedProperty.set(options, 'chart.events', events);
        },

        applyNumberFormatting(options, component) {
            const numberFormat = component.get('pieChartModel.numberFormat');

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

export default pieChart
