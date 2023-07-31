<template>

    <div class="">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('user.files')"
            :data-baseurl="route('dashboard.media.files.index')">
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

        data() {
            return {

                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    field: 'id',
                    title: 'Id',
                    sortable: true,
                    visible: false,
                }, {
                    field: 'file_preview',
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
                    width: '150',
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
