
const treeMapChart = () => {
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

            const title = component.get('treeMapChartModel.title');
            const animated = component.get('treeMapChartModel.animated');
            const distributed = component.get('treeMapChartModel.distributed');
            const onBlockClickEventName = component.get('treeMapChartModel.onBlockClickEventName');
            const data = component.get('treeMapChartModel.data');
            const colors = component.get('treeMapChartModel.colors');
            const enableShades = component.get('treeMapChartModel.enableShades');

            const series = Object.keys(data)
                .map(seriesName => ({
                    name: seriesName,
                    data: data[seriesName].map(item => ({
                        x: item.title,
                        y: item.value,
                    }))
                }))

            const options = {
                series: series,

                legend: { show: false },

                title: { text: title },

                chart: {
                    height: '100%',
                    type: 'treemap',

                    toolbar: {show: false},

                    animations: {enabled: animated},

                    events: {
                        click: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                            if (!onBlockClickEventName) {
                                return
                            }

                            const block = data[series[seriesIndex].name][dataPointIndex]

                            component.call('onBlockClick', block)
                        },
                    }
                },

                plotOptions: {
                    treemap: {
                        distributed: distributed,
                        enableShades: enableShades,
                    }
                },

                colors: colors,
            };

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        }
    }
}

export default treeMapChart
