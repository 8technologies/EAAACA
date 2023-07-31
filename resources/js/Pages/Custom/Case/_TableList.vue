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
                default: route('dashboard.cases.create'),
            },
            'baseUrl': {
                type: String,
                default: route('dashboard.cases.index'),
            },
            'url': {
                type: String,
                default: route('dashboard.cases.index'),
            },
        },
        data() {
            return {
                addModalTitle: '#Add a Case',
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
                    field: 'name',
                    title: 'Name',
                    // width: '120',
                    visible: true,
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'date_created',
                    title: 'Date Created',
                    width: '200',
                    visible: true,
                }, {
                    field: 'status',
                    title: 'Status',
                    width: '200',
                    visible: true,
                }, {
                    field: 'approved',
                    title: 'Approved',
                    width: '200',
                    visible: true,
                    formatter: (value, row) => {
                        if (row.approved == 1) {
                            return `
                                <div class="border border-success rounded px-2 py-1 smaller text-center text-success d-block">Approved</div>
                            `
                        }
                        return `
                                <a href="${ route('dashboard.cases.show', {'id': row.id}) }" class="btn btn-sm btn-primary d-block approve-case">Review</a>
                            `
                    },
                }, {
                    field: 'user',
                    title: 'Added by',
                    width: '150',
                    visible: false,
                    class: 'img-rounded-circle',
                    formatter: (value, row) => {
                        return this.authorFormatter(value, row);
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
