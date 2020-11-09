<div
    style="width: 100%; height: 100%;"
    x-data="{ ...columnChart() }"
    x-init="drawChart(@this)"
>
    <div wire:ignore x-ref="container"></div>

    <script>
        function columnChart() {
            return {
                chart: null,

                drawChart(component) {
                    if (this.chart) {
                        this.chart.destroy()
                    }

                    const animated = component.get('columnChartModel.animated') || false;
                    const onColumnClickEventName = component.get('columnChartModel.onColumnClickEventName')
                    const dataLabels = component.get('columnChartModel.dataLabels') || {};
                    const data = component.get('columnChartModel.data');
                    const sparkline = component.get('columnChartModel.sparkline');

                    const options = {
                        series: [{ data: data.map(item => item.value)}],

                        chart: {
                            type: 'bar',
                            height: '100%',

                            ...sparkline,

                            toolbar: { show: false },

                            animations: { enabled: animated },

                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    if (!onColumnClickEventName) {
                                        return
                                    }

                                    const { dataPointIndex } = config
                                    const column = data[dataPointIndex]
                                    component.call('onColumnClick', column)
                                },
                            }
                        },

                        colors: data.map(item => item.color),

                        labels: {
                            style: {
                                colors: data.map(item => item.color),
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

                        dataLabels: dataLabels,

                        xaxis: {
                            categories: data.map(item => item.title),
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

