import { mergedOptionsWithJsonConfig } from "./helpers";

const combinationChart = () => {
    return {
        chart: null,

        init() {
            setTimeout(() => {
                this.drawChart(this.$wire)
            }, 0);
        },

        drawChart(component) {
            if (this.chart) {
                this.chart.destroy()
            }

            const title = component.get("combinationChartModel.title");
            const animated = component.get("combinationChartModel.animated") || false;
            const dataLabels = component.get("combinationChartModel.dataLabels") || {};
            const data = component.get("combinationChartModel.data") || [];
            const sparkline = component.get("combinationChartModel.sparkline");
            const legend = component.get('combinationChartModel.legend');
            const grid = component.get('combinationChartModel.grid');
            const jsonConfig = component.get("combinationChartModel.jsonConfig");

            const series = Object.keys(data).map(function (name) {
              return {
                  name: name,
                  type: data[name][0].type,
                  data: data[name].map(function (item) {
                    const date = Date.parse(item.title)
      
                    if (isNaN(date)) {
                      return { x: item.title, y: item.value }
                    }
                    else {
                      return { x: date, y: item.value }
                    }
                })
              }
            })

            const titles = component.get("combinationChartModel.xAxis.categories").length > 0
              ? component.get("combinationChartModel.xAxis.categories")
              : data[series[0].name] && data[series[0].name].length > 0
              ? data[series[0].name].map(function (item) {
                const date = Date.parse(item.title)

                if (isNaN(date)) {
                  return item.title
                }
                else {
                  return date
                }
              })
              : [];

            const categories = component.get("combinationChartModel.xAxis.categories").length > 0
              ? component.get("combinationChartModel.xAxis.categories")
              : titles.sort((a, b) => a - b);

            const options = {
                series: series,

                chart: {
                    ...sparkline,

                    toolbar: { show: false },

                    animations: { enabled: animated },

                    zoom: { enabled: false },

                    events: {
                        dataPointSelection: function(event, chartContext, {seriesIndex, dataPointIndex}) {
                            if (!onColumnClickEventName) {
                                return
                            }

                            const column = data[series[seriesIndex].name][dataPointIndex]
                            component.call('onColumnClick', column)
                        },
                          markerClick: function(event, chartContext, { dataPointIndex }) {
                            if (!onPointClickEventName) {
                                return
                            }

                            const point = data[dataPointIndex]
                            component.call('onPointClick', point)
                        }
                    }
                },

                legend: legend,

                grid: grid,

                dataLabels: dataLabels,

                stroke: component.get("combinationChartModel.stroke") || {},

                theme: component.get("combinationChartModel.theme") || {},

                title: {
                    text: title,
                    
                    align: "center",
                },

                xaxis: {
                    labels: component.get("combinationChartModel.xAxis.labels"),

                    type: categories.every(function (item) {return !isNaN(item);}) ? "datetime" : "category"
                },

                yaxis: component.get("combinationChartModel.yAxis") || {},

                fill: {
                  opacity: component.get('combinationChartModel.opacity'),
                },

                theme: component.get('combinationChartModel.theme') || {},

            };

            const colors = component.get("combinationChartModel.colors");

            if (colors && colors.length > 0) {
              options['colors'] = colors
            }

            this.chart = new ApexCharts(this.$refs.container, mergedOptionsWithJsonConfig(options, jsonConfig));
            this.chart.render();
        }
    }
}

export default combinationChart
