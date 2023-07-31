<template>

    <div class="">

        <div id="toolbar">
            <inertia-link :href="route('dashboard.our_work.create')" class="btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </inertia-link>

            <ContentFilters></ContentFilters>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.our_work.index')">
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
    import ContentFilters from './../_Partials/ContentFilters'

    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'
    import FormDelete from './_FormDelete'

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
        ],
        components: {
            ContentFilters,
            FormCreate,
            FormEdit,
            FormDelete,
        },

        data() {
            return {
                addModalTitle: '#Add a Our work',
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
                    field: 'thumbnail',
                    title: '',
                    width: '80',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'title',
                    title: 'Title',
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
                    field: 'created_at',
                    title: 'Created At',
                    sortable: 'true',
                    width: '220',
                    visible: true,
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
                        return this.actionFormatterInertia(value, row)
                    },
                }]
            }
        },

    }

</script>

