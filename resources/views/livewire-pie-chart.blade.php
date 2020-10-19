<div
    class="w-full h-full"
    x-data="{ ...pieChart() }"
    x-init="drawChart(@this)"
    x-on:draw-column-chart.window="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function pieChart() {
            return {
                chart: null,

                drawChart(component) {
                    this.renderApex(component)
                },

                renderApex(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const options = {
                        series: component.get('pieChartModel.data').map(item => item.value),

                        chart: {
                            height: '100%',
                            type: 'pie',

                            animations: {
                                enabled: component.get('pieChartModel.animated') || false,
                            },

                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    const onSliceClickEventName = component.get('pieChartModel.onSliceClickEventName')

                                    if (!onSliceClickEventName) {
                                        return
                                    }

                                    const { dataPointIndex } = config
                                    const slice = component.get('pieChartModel.data')[dataPointIndex]
                                    component.call('onSliceClick', slice)
                                },
                            }
                        },

                        labels: component.get('pieChartModel.data').map(item => item.title),

                        dataLabels: {
                            enabled: false,
                        },

                        colors: component.get('pieChartModel.data').map(item => item.color),

                        fill: {
                            opacity: component.get('pieChartModel.opacity'),
                        },

                        title: {
                            text: component.get('pieChartModel.title'),
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
                    };

                    this.chart = new ApexCharts(this.$refs.container, options);
                    this.chart.render();
                }
            }
        }
    </script>
</div>

