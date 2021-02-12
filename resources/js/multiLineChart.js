
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

            const title = component.get('lineChartModel.title');
            const animated = component.get('lineChartModel.animated') || false;
            const dataLabels = component.get('lineChartModel.dataLabels') || {};
            const data = component.get('lineChartModel.data');
            const onPointClickEventName = component.get('lineChartModel.onPointClickEventName');
            const sparkline = component.get('lineChartModel.sparkline');

            const series = Object.keys(data).map(key => {
                return {
                    name: key,
                    data: data[key].map(item => item.value),
                }
            })

            const categories = component.get('lineChartModel.xAxis.categories').length > 0
                ? component.get('lineChartModel.xAxis.categories')
                : data[series[0].name].map(item => item.title)

            const options = {
                series: series,

                chart: {
                    type: 'line',
                    height: '100%',

                    ...sparkline,

                    zoom: { enabled: false },

                    toolbar: { show: false },

                    animations: { enabled: animated },

                    events: {
                        markerClick: function(event, chartContext, { seriesIndex, dataPointIndex }) {
                            if (!onPointClickEventName) {
                                return
                            }

                            const point = data[series[seriesIndex].name][dataPointIndex]
                            component.call('onPointClick', point)
                        }
                    }
                },

                dataLabels: dataLabels,

                stroke: component.get('lineChartModel.stroke') || {},

                title: {
                    text: title,
                    align: 'center'
                },

                xaxis: {
                    labels: component.get('lineChartModel.xAxis.labels'),
                    categories: categories,
                },

                yaxis: component.get('lineChartModel.yAxis') || {},
            };

            const colors = component.get('lineChartModel.colors');

            if (colors && colors.length > 0) {
                options['colors'] = colors
            }

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        }
    }
}

export default multiLineChart
