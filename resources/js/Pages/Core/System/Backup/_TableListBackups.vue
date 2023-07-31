<template>
    <div class="">
        <div id="toolbar">
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="backupMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Backup
            </button>
            <div class="dropdown-menu" aria-labelledby="backupMenu">
                <button class="dropdown-item" type="button" @click="createBackup('')">Backup all</button>
                <button class="dropdown-item" type="button" @click="createBackup('only-db')">Backup database only</button>
                <button class="dropdown-item" type="button" @click="createBackup('only-files')">Backup files only</button>
            </div>
        </div>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.backups.index', {disk: this.activeDisk})">
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
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import FunctionsMixin from '@/Mixins/Functions'

    import FormCreate from './_FormCreate'
    import FormDelete from './_FormDelete'

    export default {
        mixins: [BootstrapTableMixin, ModalComponentsMixin, FunctionsMixin],
        components: {
            FormCreate,
            FormDelete,
        },
        props: {
            disks: { required: true, type: Array },
            activeDisk: { required: true, type: String },
        },
        data() {
            return {
                pageTitle: 'Backups',
                columns: [{
                    field: 'path',
                    title: 'Path',
                    sortable: 'true',
                }, {
                    field: 'disk',
                    title: 'Disk',
                    width: '150',
                    formatter: () => {
                        return this.activeDisk
                    },
                }, {
                    field: 'size',
                    title: 'Size',
                    width: '150',
                    sortable: 'true',
                }, {
                    field: 'date',
                    title: 'Created at',
                    width: '200',
                    sortable: 'true',
                }, {
                    field: 'path',
                    title: 'Action',
                    width: '80',
                    formatter: (value, row) => {
                        var downloadLink =  `<a href="${route('dashboard.backup.download')}?disk=local&path=${row.path}"
                            title="'Download'"
                            class="mr-2 download-item text-secondary">
                                <i class="fa fa-download"></i>
                        </a>`
                        var deleteLink =  `<a href="${route('dashboard.backups.delete')}?disk=local&path=${row.path}"
                            title="'Download'"
                            class="delete-backup text-secondary">
                                <i class="fa fa-trash"></i>
                        </a>`

                        return downloadLink + deleteLink
                    },
                }]
            }
        },
        mounted() {
            // Register jQuery events

            $('body .bootstrap-table').on('click', 'a.add-item', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.showAddAsync(dataArray)
            });

            $('body .bootstrap-table').on('click', 'a.delete-backup', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.deleteBackup(dataArray)
            });
        },
        methods: {
            createBackup(option) {
                var form = {
                    option: option
                }
                var URL = route('dashboard.backups.create')

                this.$inertia.post(URL, form, {
                    onProgress: (progress) => {
                        // Handle progress event
                    },
                    onSuccess: (page) => {
                        // Handle success event
                        if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                        if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}

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
                })
            },
            
            // Delete an item
            deleteBackup (dataArray) {
                this.showSpinner = true

                var URL = dataArray['url']
                var form = {
                    _method: 'DELETE'
                };
                
                this.$inertia.post(URL, form, {
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
        beforeDestroy () {
            $('body .bootstrap-table').off('click')
        },
        created() {
            this.$delete( this.options, 'serverSort')
            this.$delete( this.options, 'sidePagination')
            this.$set( this.options, 'pageSize', 25)
            this.$set( this.options, 'showHeader', true)
        },
    }

</script>

