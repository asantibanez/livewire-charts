import { mergedOptionsWithJsonConfig } from './helpers'

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

            const title = component.get('radarChartModel.title');
            const animated = component.get('radarChartModel.animated');
            const onPointClickEventName = component.get('areaChartModel.onPointClickEventName');
            const dataLabels = component.get('radarChartModel.dataLabels');
            const data = component.get('radarChartModel.data');
            const sparkline = component.get('radarChartModel.sparkline');
            const colors = component.get('radarChartModel.colors');
            const jsonConfig = component.get('radarChartModel.jsonConfig');

            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => item.value)
                }))

            const categories = component.get('radarChartModel.xAxis.categories').length > 0
                ? component.get('radarChartModel.xAxis.categories')
                : data[series[0].name].map(item => item.title)
            ;

            const options = {
                series: series,

                chart: {
                    type: 'radar',
                    height: '100%',

                    ...sparkline,

                    toolbar: {show: false},

                    animations: {enabled: animated},

                    events: {
                        markerClick: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                            if (!onPointClickEventName) {
                                return
                            }

                            const point = data[series[seriesIndex].name][dataPointIndex]

                            component.call('onPointClick', point)
                        },
                    }
                },

                legend: component.get('radarChartModel.legend'),

                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                    },
                },

                dataLabels: dataLabels,

                xaxis: {
                    categories: categories,
                },

                title: { text: title },

                fill: {
                    opacity: component.get('radarChartModel.opacity'),
                },

                colors: colors,

                markers: {
                    size: 4
                },

            };

            this.chart = new ApexCharts(this.$refs.container, mergedOptionsWithJsonConfig(options, jsonConfig));
            this.chart.render();
        }
    }
}

export default radarChart
