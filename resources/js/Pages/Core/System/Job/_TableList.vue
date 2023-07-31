<template>

    <div class="">
        <div id="toolbar">
            <!-- <b-link :href="route('dashboard.jobs.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link> -->
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.jobs.index')">
        </BootstrapTable>
        
        <bs-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </bs-modal>

        <bs-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </bs-modal-delete>
    </div>

</template>

<script>
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'
    import FormDelete from './_FormDelete'
    import FormShow from './_FormShow'

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
        ],
        components: {
            FormCreate,
            FormEdit,
            FormDelete,
            FormShow,
        },

        data() {
            return {
                addModalTitle: '#Add a Job',
                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    width: '20',
                    visible: false,
                }, {
                    field: 'name',
                    title: 'Name',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'queue',
                    title: 'Queue',
                    width: '150',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'payload',
                    title: 'Payload',
                    width: '400',
                    visible: true,
                    formatter: (value, row) => {
                        return `
                            <div class="w-100" style="max-width:400px">
                                <pre><code>${ value }</code></pre>
                            </div>
                        `
                    },
                }, {
                    field: 'attempts',
                    title: 'Attempts',
                    width: '100',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'reserved_at',
                    title: 'Reserved at',
                    width: '150',
                    sortable: 'true',
                    visible: false,
                }, {
                    field: 'available_at',
                    title: 'Available at',
                    width: '150',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    width: '150',
                    sortable: 'true',
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    // events: 'actionEvents',
                    formatter: (value, row) => {
                        return this.actionFormatter(value, row)
                    },
                }]
            }
        },

    }

</script>

