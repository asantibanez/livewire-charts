<div
    style="width: 100%; height: 100%;"
    x-data="{ ...radarChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function radarChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const animated = component.get('radarChartModel.animated');
                    const onPointClickEventName = component.get('areaChartModel.onPointClickEventName');
                    const dataLabels = component.get('radarChartModel.dataLabels');
                    const data = component.get('radarChartModel.data');
                    const sparkline = component.get('radarChartModel.sparkline');
                    const colors = component.get('radarChartModel.colors');

                    const series = Object.keys(data)
                        .map(seriesName => ({
                            name: seriesName,
                            data: data[seriesName].map(item => item.value)
                        }))

                    const categories = component.get('radarChartModel.xAxis.categories').length > 0
                        ? component.get('radarChartModel.xAxis.categories')
                        : data[series[0].name].map(item => item.title)
                    ;

                    const options = {
                        series: series,

                        chart: {
                            type: 'radar',
                            height: '100%',


                            ...sparkline,

                            toolbar: {show: false},

                            animations: {enabled: animated},

                            events: {
                                markerClick: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                                    if (!onPointClickEventName) {
                                        return
                                    }

                                    const point = data[series[seriesIndex].name][dataPointIndex]

                                    component.call('onPointClick', point)
                                },
                            }
                        },

                        legend: component.get('radarChartModel.legend'),

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

                        title: {
                            text: component.get('radarChartModel.title'),

                        },

                        fill: {
                            opacity: component.get('radarChartModel.opacity'),
                        },

                        colors: colors,

                        markers: {
                            size: 4
                        },

                    };

                    this.chart = new ApexCharts(this.$refs.container, options);
                    this.chart.render();
                }
            }
        }
    </script>
</div>

