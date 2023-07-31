<template>
    <app-layout>

        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.system')">
                    System
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <h3 class="">
            Logs
        </h3>

        <div class="border rounded p-1 bg-white">
        <div class="row">
            <div class="col-md-6">
                <highcharts :options="chartOptions" :callback="setChartData()"></highcharts>
            </div>
            <div class="col-md-6">
                <div class="p-3">
                <div class="row">
                    <div v-for="data in chartData" :key="data.name" :class="data.name == 'All' ? 'col-md-12 mb-2' : 'col-md-6'">
                        <div class="media bg-light border rounded mb-2">
                            <i class="fa fa-list p-2"></i>
                            <div class="p-2">
                                <div>{{ data.name }}</div>
                                <div>
                                    {{ data.y }} entries - 
                                    <span>{{ data.percent }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>

        <div class="mt-4">
            <h5 class="">Available log files</h5>
            <TableList :data="localData"></TableList>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import {Chart} from 'highcharts-vue'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableListLogs'

    export default {
        props: [
            'data',
        ],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            highcharts: Chart,
            TableList,
        },
        data() {
            return {
                pageTitle: 'Logs',
                chartData: {...this.$page.props.chartdata},
                chartOptions: {
                    redraw: true,
                    chart: {
                        type: 'pie'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    title: {
                        text: null
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Population',
                        color: 'red',
                        // keys: ['y'],
                        data: [],
                    }]
                },
            }
        },
        computed: {
            localData: function () {
                var logs = this.$page.props.logs
                var data = Object.values(logs.data)
                logs.data = data

                return logs
            },
        },
        methods: {
            setChartData: function() {
                var data = this.$page.props.chartdata
                
                delete data.all
                var result = Object.values(data).map(function(value) {
                    return value
                });

                // console.log( result )
                this.chartOptions.series[0].data = result
            }
        }
    }

</script>

