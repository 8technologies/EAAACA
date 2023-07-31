<template>

    <div class="">

        <div id="toolbar">
            <b-dropdown id="dropdown-filters" variant="outline-secondary" ref="dropdown" class="dropdown-filters" no-caret>
                <template #button-content>
                    <i class="fa fa-filter"></i>
                </template>
                <b-dropdown-form>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>User</label>
                        <select2 id="user" @change="refreshBootstrapTable()" :name="route('dashboard.users.index')" :settings="{ placeholder: 'User', ajax: ajax, templateResult: formatState, templateSelection: formatState }">
                        </select2>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Method Type</label>
                        <Select2 id="method" name="method" @change="refreshBootstrapTable()" :options="methodOptions" :settings="{ placeholder: 'Method Type' }" />
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
            data-toolbar="#toolbar"
            :data-url="route('dashboard.activities.index')">
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

    export default {
        props: [
            'data',
        ],
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
            Select2Mixin,
        ],
        components: {
            FormShow,
        },

        data() {
            return {
                methodOptions: [
                    {id: '', text: 'ALL'},
                    {id: 'CONNECT', text: 'CONNECT'},
                    {id: 'DELETE', text: 'DELETE'},
                    {id: 'GET', text: 'GET'},
                    {id: 'OPTIONS', text: 'OPTIONS'},
                    {id: 'PATCH', text: 'PATCH'},
                    {id: 'POST', text: 'POST'},
                    {id: 'PUT', text: 'PUT'},
                    {id: 'TRACE', text: 'TRACE'},
                ],
                
                columns: [{
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    // width: '120',
                    visible: false,
                }, {
                    field: 'created_at',
                    title: 'Time',
                    sortable: 'true',
                    width: '150',
                    formatter: (value, row) => {
                        return this.timeAgo(value, row)
                    },
                }, {
                    field: 'description',
                    title: 'Description',
                    width: '220',
                }, {
                    field: 'userId',
                    title: 'User',
                    width: '100',
                    formatter: (value, row) => {
                        return row.user_account ? row.user_account.name : value
                    },
                }, {
                    field: 'methodType',
                    title: 'Method',
                    width: '50',
                }, {
                    field: 'route',
                    title: 'Route',
                    sortable: 'true',
                    formatter: (value, row) => {
                        var markup = `
                            <div class="text-break">
                                ${value.replace(/^.*\/\/[^\/]+/, '')}
                            </div>
                        `
                        return markup
                    },
                }, {
                    field: 'ipAddress',
                    title: 'IP Address',
                    width: '100',
                }, {
                    field: 'userAgent',
                    title: 'User Agent',
                    width: '65',
                    visible: false,
                    // events: 'actionEvents',
                    formatter: (value, row) => {
                        // console.log( row )
                        return value
                    },
                }]
            }
        },
        created() {
            this.$set( this.options, 'pageSize', 100)
            // this.$set( this.options, 'showHeader', true)
        },
    }





</script>

