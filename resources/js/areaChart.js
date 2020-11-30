
const areaChart = () => {
    return {
        chart: null,

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

            const categories = component.get('areaChartModel.xAxis.categories').length > 0
                ? component.get('areaChartModel.xAxis.categories')
                : data.map(item => item.title)
            ;

            var options = {
                series: [{
                    name: title,
                    data: data.map(item => item.value)
                }],
                chart: {
                    type: 'area',
                    height: '100%',

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

                colors: [component.get('areaChartModel.color') || '#2E93fA'],

                stroke: {
                    curve: 'straight'
                },

                title: {
                    text: title,
                    align: 'center'
                },

                labels: data.map(item => item.title),

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
            };

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        }
    }
}

export default areaChart
