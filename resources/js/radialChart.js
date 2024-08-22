import { mergedOptionsWithJsonConfig } from "./helpers";

const radialChart = () => {
    return {
        chart: null,

        init() {
            setTimeout(() => {
                this.drawChart(this.$wire);
            }, 0);
        },

        drawChart(component) {
            if (this.chart) {
                this.chart.destroy();
            }

            const data = component.get("radialChartModel.data");
            const showTotal = component.get("radialChartModel.showTotal");
            const onBarClickEventName = component.get(
                "radialChartModel.onBarClickEventName"
            );
            const jsonConfig = component.get("radialChartModel.jsonConfig");

            const colors = component.get("radialChartModel.colors");

            const options = {
                series: data.map((item) => item.value),
                labels: data.map((item) => item.title),
                colors: Object.values(colors).filter(Boolean),
                chart: {
                    height: "100%",
                    type: "radialBar",
                    events: {
                        dataPointSelection: function (
                            event,
                            chartContext,
                            payload
                        ) {
                            console.log(payload);

                            if (!onBarClickEventName) {
                                return;
                            }

                            const bar = data[payload.dataPointIndex];
                            console.log(bar);

                            component.call("onBarClick", bar);
                        },
                    },
                },
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            total: {
                                show: showTotal,
                            },
                        },
                    },
                },
            };

            this.chart = new ApexCharts(
                this.$refs.container,
                mergedOptionsWithJsonConfig(options, jsonConfig)
            );

            this.chart.render();
        },
    };
};

export default radialChart;
