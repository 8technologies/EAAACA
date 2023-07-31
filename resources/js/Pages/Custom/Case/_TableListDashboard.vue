<template>

    <div class="bs-table-maxheight-300px">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="baseUrl">
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
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    import FormShow from './_FormShow'
    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'
    import FormDelete from './_FormDelete'

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
            Select2Mixin
        ],
        props: {
            'baseUrl': {
                type: String,
                default: route('dashboard.cases.index', {
                    status: 'pending', 
                }),
            },
        },
        components: {
            FormShow,
            FormCreate,
            FormEdit,
            FormDelete,
        },
        data() {
            return {
                addModalTitle: '#Add a Case',
                datePickerOptions: {
                    format: 'Y-MM-DD',
                    keepOpen: false,
                    widgetPositioning: {vertical: 'bottom'},
                },
                columns: [
                {
                    field: 'state',
                    checkbox: true,
                    visible: false,
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
                    field: 'status',
                    title: 'Status',
                    width: '100',
                    formatter: (value, row) => {
                        return `
                            <div class="">
                                ${ '' }
                            </div>
                        `
                    },
                }, {
                    field: 'date_created',
                    title: 'Date created',
                    sortable: 'true',
                    width: '220',
                    visible: false,
                }, {
                    field: 'last_updated',
                    title: 'Last updated',
                    sortable: 'true',
                    width: '220',
                    visible: false,
                }, {
                    field: 'created_by_id',
                    title: 'Created by',
                    width: '180',
                    visible: false,
                    formatter: (value, row) => {
                        return this.authorFormatter(row.created_by ? row.created_by : value, row);
                    },
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    visible: false,
                    // events: 'actionEvents',
                    formatter: (value, row) => {
                        return this.actionFormatter(value, row)
                    },
                }]
            }
        },
        created() {
            this.$delete( this.options, 'height')
            this.$delete( this.options, 'search')
            this.$delete( this.options, 'toolbar')
            this.$delete( this.options, 'showExport')
            this.$delete( this.options, 'showColumns')
            this.$delete( this.options, 'showRefresh')
            this.$delete( this.options, 'showFullscreen')
            this.$delete( this.options, 'showToggle')
            this.$delete( this.options, 'pagination')
            // this.$set( this.options, 'showHeader', false)
            // this.$set( this.options, 'height', '250px')
            this.$set( this.options, 'classes', 'table table-md')
        },
    }

</script>

