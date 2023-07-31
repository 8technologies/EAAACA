<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.field_texts.index')">
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
                addModalTitle: '#Add a Text Field',
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
                    field: 'body',
                    title: 'Body',
                    sortable: 'true',
                    visible: false,
                }, {
                    field: 'fieldable_id',
                    title: 'Fieldable Type | Id',
                    sortable: 'true',
                    width: '350',
                    formatter: (value, row) => {
                        return row.fieldable_type + ' | ' + row.fieldable_id
                    },
                }, {
                    field: 'attributes',
                    title: 'Attributes',
                    width: '150',
                }, {
                    field: 'position',
                    title: 'Position',
                    sortable: 'true',
                    width: '50',
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    width: '220',
                    sortable: 'true',
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
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

