<template>

    <div class="">
        <div id="toolbar">
            <b-link :href="route('dashboard.blocks.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.blocks.index')">
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
                addModalTitle: '#Add a Block',
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
                    field: 'component_name',
                    title: 'Component',
                    width: '150',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'controller_name',
                    title: 'Controller',
                    width: '250',
                    sortable: 'true',
                    visible: true,
                    formatter: (value, row) => {
                        if (value) {
                            return `
                                <div class="text-break">${ value }</div>
                            `
                        }
                    },
                }, {
                    field: 'controller_method',
                    title: 'Method',
                    width: '150',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'display_style',
                    title: 'Display',
                    width: '150',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    width: '220',
                    sortable: 'true',
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
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

