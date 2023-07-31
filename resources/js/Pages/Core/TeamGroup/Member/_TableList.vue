<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.teams.members.index', data)">
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

                form: {
                    name: null,
                },

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
                    field: 'user.thumbnail',
                    title: 'Photo',
                    width: '80',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'user.name',
                    title: 'Name',
                }, {
                    field: 'role',
                    title: 'Role',
                    width: '200',
                }, {
                    field: 'created_at',
                    title: 'Joined On',
                    width: '200',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    sortable: 'true',
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '150',
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
                                <a href="${url}/${row.id}/edit" title="${row.name}" class="mr-1 edit-item btn btn-sm btn-outline-secondary">
                                    <span class="fa fa-pen"></span>
                                </a>
                                <a href="${url}/${row.id}" title="${row.name}" class="mr-1 delete-item btn btn-sm btn-outline-danger">
                                    <span class="fa fa-trash"></span>
                                    Remove
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

