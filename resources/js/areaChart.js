import { mergedOptionsWithJsonConfig } from './helpers'

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

            const title = component.get('areaChartModel.title');
            const animated = component.get('areaChartModel.animated') || false;
            const dataLabels = component.get('areaChartModel.dataLabels') || {};
            const onPointClickEventName = component.get('areaChartModel.onPointClickEventName')
            const data = component.get('areaChartModel.data');
            const sparkline = component.get('areaChartModel.sparkline');
            const jsonConfig = component.get('areaChartModel.jsonConfig');

            const series = Object.keys(data).map(key => {
                return {
                    name: key,
                    data: data[key].map(item => item.value),
                }
            })

            const categories = component.get('areaChartModel.xAxis.categories').length > 0
                ? component.get('areaChartModel.xAxis.categories')
                : data[series[0].name].map(item => item.title)

            var options = {
                series: series,

                chart: {
                    type: 'area',
                    height: '100%',

                    stacked: component.get('areaChartModel.stacked') || false,

                    ...sparkline,

                    zoom: { enabled: false },

                    toolbar: { show: false },

                    animations: { enabled: animated },

                    events: {
                        markerClick: function(event, chartContext, { dataPointIndex }) {
                            if (!onPointClickEventName) {
                                return
                            }

                            const point = data[dataPointIndex]
                            component.call('onPointClick', point)
                        }
                    }
                },

                dataLabels: dataLabels,

                colors: component.get('areaChartModel.colors') || ['#2E93fA'],

                stroke: component.get('areaChartModel.stroke') || {},

                title: {
                    text: title,
                    align: 'center'
                },

                labels: data[series[0].name].map(item => item.title),

                xaxis: {
                    labels: component.get('areaChartModel.xAxis.labels'),
                    categories: categories,
                },

                yaxis: component.get('areaChartModel.yAxis') || {},

                grid: {
                    padding: {
                        left: 0,
                        top: 0,
                        right: 0,
                        bottom: 0,
                    }
                },

                theme: component.get('areaChartModel.theme') || {},

            };

            this.chart = new ApexCharts(this.$refs.container, mergedOptionsWithJsonConfig(options, jsonConfig));
            this.chart.render();
        }
    }
}

export default areaChart
