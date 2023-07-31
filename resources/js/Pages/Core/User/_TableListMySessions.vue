<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('profile.sessions')">
        </BootstrapTable>
        
    </div>

</template>

<script>
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
        ],
        components: {
        },

        data() {
            return {

                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    // width: '120',
                    visible: false,
                }, {
                    field: 'agent.browser',
                    title: 'Agent',
                    sortable: 'true',
                    formatter: (value, row) => {
                        var device = ``

                        if (row.agent.is_desktop == true) {
                            device = `<i class="fa fa-desktop"></i>`
                        } else {
                            device = `<i class="fa fa-mobile"></i>`
                        }

                        return device + ' ' + row.agent.platform + ' - ' + row.agent.browser
                    },
                }, {
                    field: 'last_active',
                    title: 'Last Active',
                    sortable: 'true',
                    width: '220',
                    formatter: (value, row) => {
                        if (row.is_current_device == true) {
                            return 'This device'
                        }
                        return row.last_active
                    },
                }, {
                    field: 'ip_address',
                    title: 'IP Address',
                    width: '220',
                }]
            }
        },

    }

</script>

