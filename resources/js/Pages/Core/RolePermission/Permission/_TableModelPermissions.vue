<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.models.permissions', data.id)"
            :data-baseurl="route('dashboard.permissions.index')">
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
        props: [
            'data',
        ],
        mixins: [BootstrapTableMixin, ModalComponentsMixin],
        components: {
            FormCreate,
            FormEdit,
            FormDelete,
            FormShow,
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
                    visible: false,
                }, {
                    field: 'name',
                    title: 'Name',
                    sortable: 'true',
                    width: '230',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'model.name',
                    title: 'Model',
                    width: '150',
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
                        // console.log(this.actionFormatter(value, row));
                        return this.actionFormatter(value, row)
                    },
                }]
            }
        },

    }

</script>
