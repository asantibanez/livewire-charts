<div
    class="w-full h-full"
    x-data="{ ...multiLineChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function multiLineChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const title = component.get('lineChartModel.title');
                    const animated = component.get('lineChartModel.animated') || false;
                    const isMultiLine = component.get('lineChartModel.isMultiLine')
                    const data = component.get('lineChartModel.data');
                    const onPointClickEventName = component.get('lineChartModel.onPointClickEventName');

                    const series = Object.keys(data).map(key => {
                        return {
                            name: key,
                            data: data[key].map(item => item.value),
                        }
                    })

                    const categories = []

                    const options = {
                        series: series,

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
                                enabled: animated,
                            },
                            events: {
                                markerClick: function(event, chartContext, { seriesIndex, dataPointIndex }) {
                                    if (!onPointClickEventName) {
                                        return
                                    }

                                    const seriesName = Object.keys(data)[Object.keys(data).findIndex((el, index) => index === seriesIndex)]
                                    const point = data[seriesName][dataPointIndex]
                                    component.call('onPointClick', point)
                                }
                            }
                        },

                        dataLabels: {
                            enabled: false,
                        },

                        stroke: component.get('lineChartModel.stroke') || {},

                        title: {
                            text: title,
                            align: 'center'
                        },

                        xaxis: {
                            ...component.get('lineChartModel.xAxis') || {},
                            categories: categories,
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

