<template>

    <div class="">

        <div id="toolbar">
            <b-link :href="route('dashboard.permissions.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>

            <b-dropdown id="dropdown-filters" variant="outline-secondary" ref="dropdown" class="dropdown-filters" no-caret>
                <template #button-content>
                    <i class="fa fa-filter"></i>
                </template>
                <b-dropdown-form>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Model</label>
                        <select2 id="model" @change="refreshBootstrapTable()" :name="route('dashboard.models.index')" :settings="{ placeholder: 'Model', ajax: ajax, templateResult: formatState, templateSelection: formatState }">
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
            :data-url="route('dashboard.permissions.index')">
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
                addModalTitle: '#Add a Permission',
                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    visible: false,
                }, {
                    field: 'name',
                    title: 'Name',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'model.name',
                    title: 'Model',
                    width: '150',
                }, {
                    field: 'description',
                    title: 'description',
                    width: '350',
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

