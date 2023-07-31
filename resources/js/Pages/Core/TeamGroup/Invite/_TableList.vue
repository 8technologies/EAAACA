<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.teams.invites.index', data)">
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
                    field: 'email',
                    title: 'Email',
                    sortable: true,
                    formatter: (value, row) => {
                        return this.emailFormatter(value, row)
                    },
                }, {
                    field: 'role',
                    title: 'Role',
                    width: '200',
                    sortable: true,
                }, {
                    field: 'created_at',
                    title: 'Invited On',
                    width: '220',
                    sortable: true,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    width: '220',
                    sortable: true,
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '120',
                    // events: 'actionEvents',
                    formatter: (value, row) => {

                        var url = '';
                        if (this.getBootstrapTableBaseUrl()) {
                            var url = this.getBootstrapTableBaseUrl();
                        } else {
                            var url = this.getBootstrapTableUrl();
                        }

                        const markup = `
                            <div class="d-flex">
                                <a href="${url}/${row.id}" title="${row.name}" class="mr-1 edit-item btn btn-sm btn-outline-primary">
                                    <span class="fa fa-envelope"></span>
                                    Resend
                                </a>
                            </div>
                        `;

                        return markup;
                    },
                }]
            }
        },

    }

</script>

