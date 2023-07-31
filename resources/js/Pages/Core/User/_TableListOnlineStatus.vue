<template>

    <div class="bs-table-maxheight-300px">
        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.users.online-status')">
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
    import FormEditVerified from './_FormEditVerified'
    import FormEditEnabled from './_FormEditEnabled'
    import FormEditPassword from './_FormEditPassword'
    
    export default {
        mixins: [
            BootstrapTableMixin,
            ModalComponentsMixin,
            Select2Mixin,
        ],
        components: {
            FormShow,
            FormCreate,
            FormEdit,
            FormDelete,

            FormEditVerified,
            FormEditEnabled,
            FormEditPassword,
        },
        data() {
            return {
                addModalTitle: '#Add a User',
                columns: [{
                    field: 'state',
                    checkbox: true,
                    visible: false
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    width: '50',
                    visible: false
                }, {
                    field: 'thumbnail',
                    title: '',
                    width: '80',
                    class: 'img-rounded-circle',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'name',
                    title: 'Name',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return value;
                    },
                }, {
                    field: 'user_online',
                    title: 'Online Status',
                    width: '200',
                    formatter: (value, row) => {
                        var text = 'Offline'
                        var textClass = 'btn-outline-secondary'

                        if (value) {
                            text = 'Online'
                            textClass = 'btn-outline-success'
                        }

                        return `
                            <div class="btn btn-sm px-4 ${ textClass }">${ text }</div>
                        ` 
                    },
                }, {
                    field: 'last_seen',
                    title: 'Last Seen',
                    width: '200',
                    formatter: (value, row) => {
                        return value
                    },
                }, {
                    field: 'roles',
                    title: 'Roles',
                    width: '300',
                    formatter: (value, row) => {
                        return `
                            <div class="text-break">${ this.objectNameListFormatter(value, row) }</div>
                        ` 
                    },
                }
                ]
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
            this.$set( this.options, 'showHeader', false)
            // this.$set( this.options, 'height', '250px')
            this.$set( this.options, 'classes', 'table table-md')
        },
    }

</script>
