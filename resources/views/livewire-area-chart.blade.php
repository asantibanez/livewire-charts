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

                    const title = component.get('areaChartModel.title');
                    const animated = component.get('areaChartModel.animated') || false;
                    const dataLabels = component.get('areaChartModel.dataLabels') || {};
                    const onPointClickEventName = component.get('areaChartModel.onPointClickEventName')
                    const data = component.get('areaChartModel.data');

                    var options = {
                        series: [{
                            name: title,
                            data: data.map(item => item.value)
                        }],
                        chart: {
                            type: 'area',
                            height: '100%',

                            zoom: { enabled: false },

                            toolbar: { show: false },

                            animations: {
                                enabled: animated,
                            },

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

