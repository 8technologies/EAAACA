<template>

    <div class="">
        <div id="toolbar">
            <b-link :href="createUrl" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="baseUrl"
            :data-base="url">
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
    import FormShow from './_PreviewSummary'

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
        props: {
            'createUrl': {
                type: String,
                default: route('dashboard.information-requests.create'),
            },
            'baseUrl': {
                type: String,
                default: route('dashboard.information-requests.index'),
            },
            'url': {
                type: String,
                default: route('dashboard.information-requests.index'),
            },
        },
        data() {
            return {
                addModalTitle: '#Add an Information Request',
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
                    field: 'body',
                    title: 'Body',
                    width: '250',
                    visible: false,
                    formatter: (value, row) => {
                        return this.truncateFormatter(value, row)
                    },
                }, {
                    field: 'entity_status',
                    title: 'Status',
                    sortable: 'true',
                    width: '220',
                    formatter: (value, row) => {
                        return this.formatStatus(value, row)
                    },
                }, {
                    field: 'organization',
                    title: 'Requesting authority',
                    width: '220',
                    formatter: (value, row) => {
                        return row.organization ? row.organization.name : ''
                    },
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    sortable: 'true',
                    width: '220',
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    sortable: 'true',
                    width: '220',
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'user',
                    title: 'Author',
                    width: '150',
                    class: 'img-rounded-circle',
                    formatter: (value, row) => {
                        return this.authorFormatter(value, row);
                    },
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

