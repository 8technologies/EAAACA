<template>
    <app-layout>

        <template #header>
            My Notifications
        </template>

        <div class="">
            <BootstrapTable
                id="bootstrap-table"
                :columns="columns"
                :options="options"
                data-detail-view="true"
                data-detail-formatter="detailFormatter"
                :data-url="route('user.notifications')">
            </BootstrapTable>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        mixins: [BootstrapTableMixin, SeoMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'User Notifications',

                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    width: '120',
                    visible: false,
                }, {
                    field: 'type',
                    title: 'Type',
                    sortable: 'true',
                    width: '220',
                }, {
                    field: 'data',
                    title: 'Data',
                    formatter: (value, row) => {
                        return this.objectFormatter(value, row)
                    },
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    visible: false,
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '120',
                    formatter: (value, row) => {
                        return this.actionFormatter(value, row)
                    },
                }]
            }
        },
        methods: {
            // clickRow(row) {
            //     alert(JSON.stringify(row))
            // },
            detailFormatter() {
                $("div.foo").html();
            }
        }
    }

</script>
