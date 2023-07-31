<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.roles.users', data.id)"
            :data-baseurl="route('dashboard.users.index')">
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
        props: [
            'data',
        ],
        data() {
            return {
                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    width: '50',
                    visible: false
                }, {
                    field: 'thumbnail',
                    title: '',
                    width: '80',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'name',
                    title: 'Name',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row);
                    },
                }, {
                    field: 'email',
                    title: 'Email',
                    sortable: 'true',
                    width: '250',
                    formatter: (value, row) => {
                        return this.emailFormatter(value, row);
                    },
                }, {
                    field: 'roles',
                    title: 'Roles',
                    width: '200',
                    formatter: (value, row) => {
                        return this.objectNameListFormatter(value, row);
                    },
                }, {
                    field: 'email_verified_at',
                    title: 'Verified',
                    width: '50',
                    formatter: (value, row) => {
                        return value ? 'Yes' : 'No';
                    },
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    formatter: (value, row) => {
                        return this.actionFormatter(value, row)
                    },
                }]
            }
        },

    }

</script>

