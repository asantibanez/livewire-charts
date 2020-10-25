<div
    class="w-full h-full"
    x-data="{ ...columnChart() }"
    x-init="drawChart(@this)"
    x-on:draw-column-chart.window="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function columnChart() {
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
                        series: [{ data: component.get('columnChartModel.data').map(item => item.value)}],

                        chart: {
                            type: 'bar',
                            height: '100%',

                            toolbar: {
                                show: false
                            },

                            animations: {
                                enabled: component.get('columnChartModel.animated') || false,
                            },

                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    const onColumnClickEventName = component.get('columnChartModel.onColumnClickEventName')

                                    if (!onColumnClickEventName) {
                                        return
                                    }

                                    const { dataPointIndex } = config
                                    const column = component.get('columnChartModel.data')[dataPointIndex]
                                    component.call('onColumnClick', column)
                                },
                            }
                        },

                        colors: component.get('columnChartModel.data').map(item => item.color),

                        labels: {
                            style: {
                                colors: component.get('columnChartModel.data').map(item => item.color),
                            },
                        },

                        legend: component.get('columnChartModel.legend') || {},

                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '40%',
                                distributed: true,
                            },
                        },

                        dataLabels: {
                            enabled: false,
                        },

                        xaxis: {
                            categories: component.get('columnChartModel.data').map(item => item.title),
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

                    this.chart = new ApexCharts(this.$refs.container, options);
                    this.chart.render();
                }
            }
        }
    </script>
</div>

