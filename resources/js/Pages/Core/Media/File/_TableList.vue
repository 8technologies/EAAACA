<template>

    <div class="">

        <div id="toolbar">
            <b-link :href="route('dashboard.media.files.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>

            <b-dropdown id="dropdown-filters" variant="outline-secondary" ref="dropdown" class="dropdown-filters" no-caret>
                <template #button-content>
                    <i class="fa fa-filter"></i>
                </template>
                <b-dropdown-form>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Owner</label>
                        <select2 id="user" @change="refreshBootstrapTable()" :name="route('dashboard.users.index')" :settings="{ placeholder: 'Owner', ajax: ajax, templateResult: formatState, templateSelection: formatState }">
                        </select2>
                    </div>
                </div>
                </b-dropdown-form>
                <b-dropdown-divider></b-dropdown-divider>
                <div class="px-2">
                    <b-link href="#" class="btn btn-default clear-Filters w-100 d-block">
                        Reset Filters
                    </b-link>
                </div>
            </b-dropdown>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.media.files.index')">
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

    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'
    import FormDelete from './_FormDelete'
    import FormShow from './_FormShow'

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
            Select2Mixin,
        ],
        components: {
            FormCreate,
            FormEdit,
            FormDelete,
            FormShow,
        },
        data() {
            return {
                addModalTitle: '#Add a File',
                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    field: 'id',
                    title: 'Id',
                    sortable: true,
                    visible: false,
                }, {
                    field: 'thumbnail',
                    title: '',
                    width: '80',
                    formatter: (value, row) => {
                        if (value !== null) {
                            return this.imageUrlFormatter(value, row);
                        }
                        return `
                            <div class="img-thumbnail d-block text-center">
                                <i class="${row.file_icon} select-preview border-0"></i>
                            </div>
                            `
                    },
                }, {
                    field: 'name',
                    title: 'Name',
                    sortable: true,
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'file_name',
                    title: 'File Name',
                    visible: false,
                    sortable: true,
                }, {
                    field: 'download_link',
                    title: 'Download',
                    visible: true,
                    width: '100',
                    formatter: (value, row) => {
                        console.log( row )
                        return `
                        <a href="${ value }" target="_blank" class="text-wrap text-break" style="max-width:250px;">
                            Download
                        </a>
                        `
                    },
                }, {
                    field: 'file_usage',
                    title: 'File Usage',
                    width: '150',
                }, {
                    field: 'user.name',
                    title: 'Owner',
                    visible: true,
                    width: '100',
                }, {
                    field: 'upload_folder',
                    title: 'Folder',
                    visible: true,
                    width: '100',
                }, {
                    field: 'disk',
                    title: 'Storage disk',
                    sortable: true,
                    visible: false,
                    width: '150',
                }, {
                    field: 'mime_type',
                    title: 'Mime Type',
                    sortable: true,
                    width: '250',
                    formatter: (value, row) => {
                        return `
                        <div class="text-wrap text-break" style="max-width:250px;">
                            ${ value }
                        </div>
                        `
                    },
                }, {
                    field: 'size',
                    title: 'File Size',
                    sortable: true,
                    width: '150',
                    formatter: (value, row) => {
                        return row.file_size
                    },
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    sortable: true,
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    sortable: true,
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

