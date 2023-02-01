
const columnChart = () => {
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

            const title = component.get('columnChartModel.title');
            const animated = component.get('columnChartModel.animated') || false;
            const onColumnClickEventName = component.get('columnChartModel.onColumnClickEventName')
            const dataLabels = component.get('columnChartModel.dataLabels') || {};
            const sparkline = component.get('columnChartModel.sparkline');
            const legend = component.get('columnChartModel.legend')
            const grid = component.get('columnChartModel.grid');
            const columnWidth = component.get('columnChartModel.columnWidth');
            const horizontal = component.get('columnChartModel.horizontal');

            const data = component.get('columnChartModel.data');
            const series = [{
                name: title,
                data: data.map(item => item.value)
            }]

            const options = {
                series: series,

                chart: {
                    type: 'bar',
                    height: '100%',

                    ...sparkline,

                    toolbar: { show: false },

                    animations: { enabled: animated },

                    events: {
                        dataPointSelection: function(event, chartContext, config) {
                            if (!onColumnClickEventName) {
                                return
                            }

                            const { dataPointIndex } = config
                            const column = data[dataPointIndex]
                            component.call('onColumnClick', column)
                        },
                    }
                },

                colors: data.map(item => item.color),

                labels: {
                    style: {
                        colors: data.map(item => item.color),
                    },
                },

                legend: legend,

                grid: grid,

                plotOptions: {
                    bar: {
                        horizontal: horizontal,
                        columnWidth: `${columnWidth}%`,
                        distributed: true,
                    },
                },

                dataLabels: dataLabels,

                xaxis: {
                    categories: data.map(item => item.title),
                },

                yaxis: {
                    title: {
                        text: component.get('columnChartModel.title'),
                    }
                },

                fill: {
                    opacity: component.get('columnChartModel.opacity') || 0.5
                },
            };

            const colors = component.get('columnChartModel.colors');

            if (colors && colors.length > 0) {
                options['colors'] = colors
            }

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        }
    }
}

export default columnChart
