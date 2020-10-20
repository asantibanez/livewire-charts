<div
    class="w-full h-full"
    x-data="{ ...areaChart() }"
    x-init="drawChart(@this)"
    x-on:draw-column-chart.window="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function areaChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    var options = {
                        series: [{
                            name: component.get('areaChartModel.title'),
                            data: component.get('areaChartModel.data').map(item => item.value)
                        }],
                        chart: {
                            type: 'area',
                            height: '100%',

                            zoom: { enabled: false },

                            toolbar: { show: false },

                            animations: {
                                enabled: component.get('areaChartModel.animated') || false,
                            },

                            events: {
                                markerClick: function(event, chartContext, { dataPointIndex }) {
                                    const onPointClickEventName = component.get('areaChartModel.onPointClickEventName')
                                    if (!onPointClickEventName) {
                                        return
                                    }

                                    const point = component.get('areaChartModel.data')[dataPointIndex]
                                    component.call('onPointClick', point)
                                }
                            }
                        },

                        dataLabels: {
                            enabled: false
                        },

                        colors: [component.get('areaChartModel.color') || '#2E93fA'],

                        stroke: {
                            curve: 'straight'
                        },

                        title: {
                            text: component.get('areaChartModel.title'),
                            align: 'center'
                        },

                        labels: component.get('areaChartModel.data').map(item => item.title),

                        xaxis: component.get('areaChartModel.xAxis') || {},

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
    </script>
</div>

