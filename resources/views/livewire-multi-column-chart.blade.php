<div
    class="w-full h-full"
    x-data="{ ...multiColumnChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function multiColumnChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const stacked = component.get('columnChartModel.isStacked');
                    const animated = component.get('columnChartModel.animated');
                    const onColumnClickEventName = component.get('columnChartModel.onColumnClickEventName')
                    const dataLabels = component.get('columnChartModel.dataLabels');
                    const data = component.get('columnChartModel.data');
                    const sparkline = component.get('columnChartModel.sparkline');

                    const series = Object.keys(data)
                        .map(seriesName => ({
                            name: seriesName,
                            data: data[seriesName].map(item => item.value)
                        }))

                    const categories = component.get('columnChartModel.xAxis.categories').length > 0
                        ? component.get('columnChartModel.xAxis.categories')
                        : data[series[0].name].map(item => item.title)
                    ;

                    const options = {
                        series: series,

                        chart: {
                            type: 'bar',
                            height: '100%',
                            stacked: stacked,

                            ...sparkline,

                            toolbar: { show: false },

                            animations: { enabled: animated },

                            events: {
                                dataPointSelection: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                                    if (!onColumnClickEventName) {
                                        return
                                    }

                                    const column = data[series[seriesIndex].name][dataPointIndex]
                                    component.call('onColumnClick', column)
                                },
                            }
                        },

                        legend: component.get('columnChartModel.legend'),

                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '50%',
                            },
                        },

                        dataLabels: dataLabels,

                        xaxis: {
                            categories: categories,
                        },

                        yaxis: {
                            title: {
                                text: component.get('columnChartModel.title'),
                            }
                        },

                        fill: {
                            opacity: component.get('columnChartModel.opacity'),
                        },
                    };

                    this.chart = new ApexCharts(this.$refs.container, options);
                    this.chart.render();
                }
            }
        }
    </script>
</div>

