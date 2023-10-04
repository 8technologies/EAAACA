<template>
    <PieChart :title="chart.title" :subtitle="chart.subtitle" :backgroundColor="chart.backgroundColor"
        :gridLineColor="chart.gridLineColor" :colors="chart.colors" :thousandsSep="chart.thousandsSep"
        :decimalPoint="chart.decimalPoint" :height="chart.height" :yAxis="chart.yAxis" :xAxis="chart.xAxis"
        :series="chart.series" :customStyles="chart.customStyles" />
</template>
  
<script>
import { PieChart } from 'vuejs-highcharts'

export default {
    name: 'PieChartSample',
    props: [
        'data',
    ],
    components: {
        PieChart
    },
    data() {
        return {
            chart: {
                title: 'Information Requests',
                // subtitle: 'Pie chart subtitle',
                // backgroundColor: '#fff',
                // gridLineColor: '#ccd6eb',
                colors: [
                    '#007bff',
                    '#dc3545',
                    '#ffc107',
                    '#6c757d',
                    '#17a2b8',
                    '#28a745',
                ],
                // tooltip: {
                //     formatter: function(tooltip){
                //         return point.y
                //     }
                // },
                thousandsSep: '.',
                decimalPoint: ',',
                height: 400,
                xAxis: {
                    title: {
                        text: 'xAxis title'
                    },
                },
                yAxis: {
                    title: {
                        text: 'yAxis title'
                    }
                },
                series: [{
                    data: this.data
                }],
                // crosshair: true,
            }
        }
    }
}
</script>
  