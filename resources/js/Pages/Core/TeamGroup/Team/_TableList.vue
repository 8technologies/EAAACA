<template>

    <div class="">

        <div id="toolbar">
            <b-link :href="route('dashboard.teams.create')" class="add-item btn btn-primary">
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
            :data-url="route('dashboard.teams.index')">
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
        },

        data() {
            return {
                addModalTitle: '#Add a Team',
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
                    width: '250',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row)
                    },
                }, {
                    field: 'owner.thumbnail',
                    title: 'Owner',
                    width: '80',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'owner.name',
                    title: 'Owner\'s Name',
                }, {
                    field: 'users_count',
                    title: 'Members',
                    sortable: 'true',
                    width: '80',
                }, {
                    field: 'team_invitations_count',
                    title: 'Invitations',
                    sortable: 'true',
                    width: '80',
                }, {
                    field: 'created_at',
                    title: 'Created At',
                    sortable: 'true',
                    visible: false,
                    formatter: (value, row) => {
                        return this.dateTimeFormatter(value, row)
                    },
                }, {
                    field: 'updated_at',
                    title: 'Updated At',
                    sortable: 'true',
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

