<div
    class="w-full h-full"
    x-data="{ ...pieChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function pieChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const title = component.get('pieChartModel.title');
                    const animated = component.get('pieChartModel.animated') || false
                    const dataLabels = component.get('pieChartModel.dataLabels') || {}
                    const onSliceClickEventName = component.get('pieChartModel.onSliceClickEventName')
                    const data = component.get('pieChartModel.data')
                    const sparkline = component.get('pieChartModel.sparkline')

                    const options = {
                        series: data.map(item => item.value),

                        chart: {
                            height: '100%',
                            type: 'pie',

                            ...sparkline,

                            animations: { enabled: animated },

                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    if (!onSliceClickEventName) {
                                        return
                                    }

                                    const { dataPointIndex } = config
                                    const slice = data[dataPointIndex]
                                    component.call('onSliceClick', slice)
                                },
                            }
                        },

                        labels: data.map(item => item.title),

                        dataLabels: dataLabels,

                        colors: data.map(item => item.color),

                        fill: {
                            opacity: component.get('pieChartModel.opacity'),
                        },

                        title: {
                            text: title,
                            align: 'center',
                        },

                        responsive: [
                            {
                                breakpoint: 600,
                                options: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        ],

                        legend: component.get('pieChartModel.legend') || {},
                    };

                    this.chart = new ApexCharts(this.$refs.container, options);
                    this.chart.render();
                }
            }
        }
    </script>
</div>

