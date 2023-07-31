<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :data="data.data"
            :options="options">
        </BootstrapTable>
    </div>

</template>

<script>
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

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
            FormShow,
        },
        data() {
            return {
                columns: [{
                    field: 'date',
                    title: 'Date',
                    // width: '120',
                    formatter: (value, row) => {
                        return `
                            <a href="${ route('dashboard.logs.show', value)}" title="${value}" class="mr-2 inertia-link">
                                ${value}
                            </a>`
                    },
                }, {
                    field: 'all',
                    title: 'All',
                    width: '65',
                }, {
                    field: 'emergency',
                    title: 'Emergency',
                    width: '65',
                }, {
                    field: 'alert',
                    title: 'Alert',
                    width: '65',
                }, {
                    field: 'critical',
                    title: 'Critical',
                    width: '65',
                }, {
                    field: 'error',
                    title: 'Error',
                    width: '65',
                }, {
                    field: 'warning',
                    title: 'Warning',
                    width: '65',
                }, {
                    field: 'notice',
                    title: 'Notice',
                    width: '65',
                }, {
                    field: 'info',
                    title: 'Info',
                    width: '65',
                }, {
                    field: 'debug',
                    title: 'Debug',
                    width: '65',
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    formatter: (value, row) => {
                        return `
                            <a href="${ route('dashboard.logs.download', row.date)}" title="${row.date}" class="mr-2">
                                <i class="fa fa-download"></i>
                            </a>
                            <a href="${ route('dashboard.logs.show', row.date)}/delete" data-date="${ row.date }" title="${row.date}" class="delete-log text-danger">
                                <i class="fa fa-trash"></i>
                            </a>`
                    },
                }]
            }
        },
        mounted() {
            // Register jQuery events

            $('body .bootstrap-table').on('click', 'a.delete-log', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                    'date':  el.attr('data-date'),
                }
                this.delete(dataArray)
            });
        },
        beforeDestroy () {
            $('body .bootstrap-table').off('click')
        },
        methods: {
            delete: function(dataArray) {

                var form = {
                    date: dataArray['date']
                }
                
                this.$inertia.post(dataArray['url'], form, {
                    onProgress: (progress) => {
                        // Handle progress event
                    },
                    onSuccess: (page) => {
                        // Handle success event
                        if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                        this.showSuccessMessage(page.props.flash.success)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    },
                    onFinish: () => {
                        // event.srcElement.submit.firstChild.className = ''
                    }
                }); 
            },
        },
        created() {
            this.$delete( this.options, 'serverSort')
            // this.$delete( this.options, 'showExport')
            this.$delete( this.options, 'sidePagination')

            this.$set( this.options, 'pageSize', 10)
            this.$set( this.options, 'showHeader', true)
        },
    }

</script>

