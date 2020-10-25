<div
    class="w-full h-full"
    x-data="{ ...lineChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function lineChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const options = {
                        series: [{
                            name: component.get('lineChartModel.title'),
                            data: component.get('lineChartModel.data').map(item => item.value),
                        }],

                        chart: {
                            type: 'line',
                            height: '100%',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: component.get('lineChartModel.animated') || false,
                            },
                            events: {
                                markerClick: function(event, chartContext, { dataPointIndex }) {
                                    const onPointClickEventName = component.get('lineChartModel.onPointClickEventName')
                                    if (!onPointClickEventName) {
                                        return
                                    }

                                    const point = component.get('lineChartModel.data')[dataPointIndex]
                                    component.call('onPointClick', point)
                                }
                            }
                        },

                        dataLabels: {
                            enabled: false
                        },

                        stroke: component.get('lineChartModel.stroke') || {},

                        title: {
                            text: component.get('lineChartModel.title'),
                            align: 'center'
                        },

                        xaxis: {
                            ...component.get('lineChartModel.xAxis') || {},
                            categories: component.get('lineChartModel.data').map(item => item.title),
                        },

                        yaxis: component.get('lineChartModel.yAxis') || {},

                        annotations: {
                            points: component.get('lineChartModel.markers').map(item => {
                                    return {
                                        x: item.title,
                                        y: item.value,
                                        marker: {
                                            size: 6,
                                            fillColor: '#fff',
                                            strokeColor: item.strokeColor,
                                            radius: 2,
                                        },
                                        label: {
                                            offsetY: 0,
                                            style: {
                                                color: item.textColor,
                                                background: item.textBackgroundColor,
                                            },
                                            text: item.text || '',
                                        }
                                    }
                                }
                            )
                        },
                    };

                    this.chart = new ApexCharts(this.$refs.container, options);
                    this.chart.render();
                }
            }
        }
    </script>
</div>

