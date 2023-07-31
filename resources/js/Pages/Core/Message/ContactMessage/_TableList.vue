<template>

    <div class="">
        <div id="toolbar">
            <b-link :href="route('dashboard.contact_messages.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.contact_messages.index')">
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
                addModalTitle: '#Add a Contact Messages',
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
                    field: 'message',
                    title: 'Message',
                    visible: true,
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'name',
                    title: 'Name',
                    width: '150',
                }, {
                    field: 'email',
                    title: 'Email',
                    width: '250',
                    sortable: 'true',
                    visible: true,
                    formatter: (value, row) => {
                        return `<div class="text-break">${ this.emailFormatter(value, row) }</div>`
                    },
                }, {
                    field: 'phone_number',
                    title: 'Phone number',
                    width: '150',
                    sortable: 'true',
                    visible: true,
                }, {
                    field: 'read_at',
                    title: 'Read At',
                    sortable: 'true',
                    width: '150',
                    formatter: (value, row) => {
                        return value ? this.dateTimeFormatter(value, row) : ''
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

