<template>

    <div class="">

        <div id="toolbar">
            <inertia-link :href="route('dashboard.taxonomy_terms.create')" class="btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </inertia-link>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.taxonomy_terms.index')">
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

    import FormShow from './_FormShow'
    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'
    import FormDelete from './_FormDelete'

    export default {
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
        ],
        components: {
            FormShow,
            FormCreate,
            FormEdit,
            FormDelete,
        },

        data() {
            return {
                addModalTitle: '#Add a Taxonomy Term',
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
                    field: 'parent_id',
                    title: 'Parent',
                    width: '150',
                    formatter: (value, row) => {
                        return row.parent ? row.parent.name : value
                    },
                }, {
                    field: 'taxonomy_type_id',
                    title: 'Taxonomy type',
                    width: '150',
                    formatter: (value, row) => {
                        return row.taxonomy_type ? row.taxonomy_type.name : value
                    },
                }, {
                    field: 'slug',
                    title: 'Slug',
                    width: '150',
                }, {
                    field: 'description',
                    title: 'Description',
                    width: '250',
                    visible: false,
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    // events: 'actionEvents',
                    formatter: (value, row) => {
                        return this.actionFormatterInertia(value, row)
                    },
                }]
            }
        },

    }

</script>

