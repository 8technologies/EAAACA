<template>

    <div class="">

        <div id="toolbar">
            <b-link :href="route('dashboard.models.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.models.index')">
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

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
        ],
        components: {
            FormCreate,
            FormEdit,
            FormDelete,
        },

        data() {
            return {
                addModalTitle: '#Add a Model',
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
                    field: 'name',
                    title: 'Name',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'model_permissions_count',
                    title: 'Total Permissions',
                    width: '150',
                    sortable: 'true',
                }, {
                    field: 'description',
                    title: 'description',
                    width: '350',
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

