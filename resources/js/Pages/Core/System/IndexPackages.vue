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
            System packages
        </h3>

        <div class="my-">
            <BootstrapTable
                :id="tableID"
                ref="bootstrapTable"
                :columns="columns"
                :options="options"
                :data="data.packages">
            </BootstrapTable>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import SeoMixin from '@/Mixins/SEO'

    export default {
        props: ['data'],
        mixins: [SeoMixin, BootstrapTableMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'System packages',
                columns: [{
                    field: 'name',
                    title: 'Name',
                    formatter: (value, row) => {
                        return `<strong>${value}</strong>: ${row.version}`
                    },
                    sortable: 'true',
                }, {
                    field: 'dependencies',
                    title: 'Dependencies',
                    width: '300',
                    formatter: (value, row) => {
                        var dependencies = `<ul class="pl-3">`
                        Object.keys(value).forEach(key => {
                            dependencies += `<li>${key}: ${value[key]}</li>`
                        });
                        return dependencies + `</ul>`
                    },
                }, {
                    field: 'dev-dependencies',
                    title: 'Dev dependencies',
                    width: '300',
                    formatter: (value, row) => {
                        var dependencies = `<ul class="pl-3">`
                        Object.keys(value).forEach(key => {
                            dependencies += `<li>${key}: ${value[key]}</li>`
                        });
                        return dependencies + `</ul>`
                    },
                }]
            }
        },
        created() {
            this.$delete( this.options, 'serverSort')
            // this.$delete( this.options, 'showExport')
            this.$delete( this.options, 'sidePagination')

            this.$set( this.options, 'pageSize', 10)
            this.$set( this.options, 'showHeader', true)
        },
    }

</script>

