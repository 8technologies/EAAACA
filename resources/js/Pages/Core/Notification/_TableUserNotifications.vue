<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.users.notifications', user.id)"
            :data-baseurl="route('dashboard.notifications.index')">
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
                user: this.$page.props.user,
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
                    field: 'notifiable_type',
                    title: 'Notifiable Type',
                    width: '150',
                    sortable: 'true',
                }, {
                    field: 'notifiable_id',
                    title: 'Id',
                    width: '75',
                    sortable: 'true',
                }, {
                    field: 'category',
                    title: 'Category',
                }, {
                    field: 'type',
                    title: 'Type',
                    sortable: 'true',
                    visible: false,
                    width: '220',
                }, {
                    field: 'read_at',
                    title: 'Read At',
                    sortable: 'true',
                    width: '200',
                    formatter: (value, row) => {
                        return value ? this.dateTimeFormatter(value, row) : ''
                    },
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    sortable: 'true',
                    width: '200',
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    sortable: 'true',
                    width: '200',
                    visible: false,
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

