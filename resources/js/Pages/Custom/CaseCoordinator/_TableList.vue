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
        props: {
            'createUrl': {
                type: String,
                default: route('dashboard.case-coordinators.create'),
            },
            'baseUrl': {
                type: String,
                default: route('dashboard.case-coordinators.index'),
            },
            'url': {
                type: String,
                default: route('dashboard.case-coordinators.index'),
            },
        },
        data() {
            return {
                addModalTitle: '#Add a Case coordinator',
                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    field: 'id',
                    title: 'ID',
                    sortable: 'true',
                    // width: '120',
                    visible: false,
                }, {
                    field: 'contact_point.thumbnail',
                    title: '',
                    width: '80',
                    class: 'img-rounded-circle',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'contact_point.name',
                    title: 'Name',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row);
                    },
                }, {
                    field: 'case_id',
                    title: 'Case',
                    width: '180',
                    sortable: 'true',
                    visible: true,
                    formatter: (value, row) => {
                        return row.case.name
                    },
                }, {
                    field: 'contact_point.organization_id',
                    title: 'Organization',
                    width: '150',
                    formatter: (value, row) => {
                        return row.contact_point.organization ? row.contact_point.organization.name : value;
                    },
                }, {
                    field: 'contact_point.email',
                    title: 'Email',
                    sortable: 'true',
                    width: '250',
                    formatter: (value, row) => {
                        return `
                            <div class="text-break">${ this.emailFormatter(value, row) }</div>
                        ` 
                    },
                }, {
                    field: 'contact_point.telephone_number',
                    title: 'Telephone',
                    width: '150',
                }, {
                    field: 'contact_point.enabled',
                    title: 'Enabled',
                    width: '50',
                    visible: false,
                    formatter: (value, row) => {
                        return this.formatEnabled(value, row);
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

